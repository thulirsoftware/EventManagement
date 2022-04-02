<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Donation;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Redirect;
use URL;
use Auth;

class DonationPaymentController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function donationpaymentComplete(Request $request)
    {
        $payments = Session::get('donationshippaymentId');
        $purchased = Donation::where('id',$payments)->first();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Donation Payment')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($purchased->amount);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($purchased->amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Donation Payment');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('donation.status'))
            ->setCancelUrl(URL::route('donation.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
            $purchased->payment_id = $payment->getID();
            $purchased->save();

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('donation.add');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('sponsor.add');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');

       
        Session::forget('paymentId');
        return redirect('/donations')->withSuccess('Donation Added Successfully');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');
         $purchased = Donation::where('payment_id',$payment_id)->first();
        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {

            $purchased->payment_status = 'Payment failed';
            $purchased->save();

            \Session::put('error','Payment failed');
             return redirect('/donations')->withSuccess('Payment Failed');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {   
         
        $purchased->payment_status = $result->getState();
        $purchased->save();

            \Session::put('success','Payment success !!');
            
               \Mail::send('emails.donation_email', ['donation' => $purchased], function($message) use($request){

              $message->to(Auth::user()->email);

              $message->subject('Donation Payment');

          });
          
            return redirect('/donations')->withSuccess('Donation Added  Successfully');
        }
        $purchased->payment_status ='Payment failed';
        $purchased->save();
        
           \Mail::send('emails.donation_email', ['donation' => $purchased], function($message) use($request){

              $message->to(Auth::user()->email);

              $message->subject('Donation Payment');

          });
          
        \Session::put('error','Payment failed !!');
       return redirect('/donations')->withSuccess('Payment Failed');
    }
}
