<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\MembershipBuy;
use Redirect;
use URL;
use Session;
use Auth;
use App\User;
use App\FamilyMember;
use App\NonMember;
use Carbon\Carbon;
use App\Member;
use App\MembershipConfig;

class MembershipPaymentController extends Controller
{
     private $_api_context;
    
    public function __construct()
    {
            
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function membershippaymentComplete(Request $request)
    {
        $membership_paymentId = Session::get('membership_paymentId');
        $purchased = MembershipBuy::where('id',$membership_paymentId)->first();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Membership')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($purchased->membership_amount);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($purchased->membership_amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Membership Payment');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('membership.status'))
            ->setCancelUrl(URL::route('membership.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
            $purchased->Inst_No = $payment->getID();
            $purchased->save();

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('membership');                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('membership');                
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

        Session::forget('membership_paymentId');
        return redirect('/MemberShip')->withSuccess('Unknown error occurred');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');
         $purchased = MembershipBuy::where('Inst_No',$payment_id)->first();
        Session::forget('paypal_payment_id');
        
         $memberships = MembershipConfig::where('id',$purchased->membership_id)->first();
         
         
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {

            $purchased->payment_status = 'Payment failed';
            $purchased->save();

            \Session::put('error','Payment failed');
             return redirect('/MemberShip')->withSuccess('Payment Failed');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {   
         
        $purchased->payment_status = $result->getState();
        $purchased->save();
        
            $member = Member::where('user_id',Auth::user()->id)->first();
            if($member==null)
            {
                  $NonMember = NonMember::where('user_id',Auth::user()->id)->first();
           }
            else
           {
                    $NonMember = Member::where('user_id',Auth::user()->id)->first();
            }
    
          
    
            $user = User::whereRaw('id = (select max(`id`) from users)')->get()->toArray();
    
            if($user){
            $userId=Auth::user()->id;
    
            $Member_Id='NETS'.sprintf("%07d", $userId);
            }else{
                $Member_Id = "NETS0000001";
            }
            $this_year =  Carbon::now()->format('Y');
            if($member==null)
            {
    
                $Member = new Member();
                $Member->Member_Id = $Member_Id;
                $Member->firstName = $NonMember->firstName;
                $Member->lastName = $NonMember->lastName;
                $Member->mobile_number = $NonMember->mobile_number;
                $Member->Email_Id = $NonMember->Email_Id;
                $Member->user_id = Auth::user()->id;
                $Member->addressLine1 = $NonMember->addressLine1;
                $Member->addressLine2 = $NonMember->addressLine2;
                $Member->country = $NonMember->country;
                $Member->state = $NonMember->state;
                $Member->zipCode = $NonMember->zipCode;
                $Member->gender = $NonMember->gender;
                $Member->dob = $NonMember->dob;
                $Member->maritalStatus = $NonMember->maritalStatus;
                $Member->membershipAmount = $purchased->membership_amount;
                $Member->membershipType =$purchased->membership_code;
                $Member->membershipExpiryDate = date('Y').'-12-31';
                $Member->save();
                 $NonMember = NonMember::where('user_id',Auth::user()->id)->delete();
              
            }
            else
            {
                $Member = Member::where('Email_Id',$NonMember->Email_Id)->first();
                $Member->membershipExpiryDate = date('Y').'-12-31';
                $Member->save();
    
            }
        
            $User = User::find(Auth::user()->id);
            $User->Member_Id = $Member_Id;
            $User->save();
                    
             $FamilyMember = FamilyMember::where('user_id',Auth::user()->id)->first();
            if($FamilyMember)
            {
                
                 $FamilyMember = FamilyMember::where('user_id',Auth::user()->id)->update(['Member_Id' => $Member_Id]);
            }
                    
           
                

            \Session::put('success','Payment success !!');
            
             \Mail::send('emails.membership_email', ['payment' => $purchased], function($message) use($request){

              $message->to(Auth::user()->email);

              $message->subject('Membership Payment');

          });
            return redirect('/MemberShip')->withSuccess('Membership Purchased Successfully');
        }
        $purchased->payment_status ='Payment failed';
        $purchased->save();
        
        $member = Member::where('Email_Id',Auth::user()->email)->first();
        
        \Session::put('error','Payment failed !!');
          \Mail::send('emails.membership_email', ['payment' => $purchased,'member'=>$member], function($message) use($request){

              $message->to(Auth::user()->email);

              $message->subject('Membership Payment');

          });
          
       return redirect('/MemberShip')->withSuccess('Payment Failed');
    }
}
