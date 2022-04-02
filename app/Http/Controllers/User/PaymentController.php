<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\TicketPurchase;
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

class PaymentController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function memberpaymentComplete(Request $request)
    {
        $payments = Session::get('paymentId');
        $purchased = TicketPurchase::where('id',$payments)->first();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Event Registration')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($purchased->totalAmount);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($purchased->totalAmount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Event Registration Payment');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
            $purchased->paymentId = $payment->getID();
            $purchased->save();

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('member.tickets');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('member.tickets');                
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
        return redirect('/memberTickets')->withSuccess('Ticket Purchased Successfully');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');
         $purchased = TicketPurchase::where('paymentId',$payment_id)->first();
        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {

            $purchased->paymentStatus = 'Payment failed';
            $purchased->save();

            \Session::put('error','Payment failed');
             return redirect('/memberTickets')->withSuccess('Payment Failed');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {   
         
        $purchased->paymentStatus = $result->getState();
        $purchased->save();

             \Mail::send('emails.event_registration_email', ['ticketPurchase' => $purchased], function($message) use($request){

              $message->to(Auth::user()->email);

              $message->subject('Event Registration Payment');

          });
            return redirect('/memberTickets')->withSuccess('Ticket Purchased Successfully');
        }
        $purchased->paymentStatus ='Payment failed';
        $purchased->save();

        \Session::put('error','Payment failed !!');
        
          \Mail::send('emails.event_registration_email', ['ticketPurchase' => $purchased], function($message) use($request){

              $message->to(Auth::user()->email);

              $message->subject('Event Registration Payment');

          });
            Session::forget('foodTickets');
            Session::forget('entryTickets');
            Session::forget('TicketStore');
            Session::forget('CompetitionStore');
            Session::forget('Events');
       return redirect('/memberTickets')->withSuccess('Payment Failed');
    }
}
