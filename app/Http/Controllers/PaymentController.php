<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use Carbon\Carbon;
use Auth;
use App\Payment as Pay;
use App\Member;
use App\NonMember;
use App\TicketPurchase;
use App\TicketPurchaseDetail;
use App\MembershipBuy;
use PayPal\Rest\ApiContext;
use PayPal\Api\ExecutePayment;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Http\Response as Res;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use Validator;
use Session;
use Response;
use App\User;
use App\Models\Employee;
use App\Models\Tamilschool;
use App\Models\EventTicket;
use App\Models\Event;
use App\Models\Membership_Config;
use App\Role;
use DateTime;



class PaymentController extends Controller
{


    public function membershipPaymentCreate(Request $request)
    {


        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdEXuIuVdlZIhhDfIlvmsBFdOPcCqmeUT6K6H5RslUOVzUeBwbFDz5S8rZN-Qiw8q4_Fe7r4bG_KVkLO',
                'EEqvrtJoBFYvWLzRxhpg3IlEg13nDDsPhP1toLm0V37NfQPxTZ23fiu0zNt38hCX4EGGhjpe6YEZMNxb'
            )
        );
        
        if(session()->has('Membership'))
        {
          $data=Session::get('Membership');  
        }
        else
        {
          Session::forget('Membership');
          return redirect('/membership');
        }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");        

        $item1 = new Item();
        $item1->setName($data['membership_desc'])
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($data['membership_amount']);

       //dd($data);
        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($data['membership_amount']);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($data['email'])
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('http://localhost:8000/membershipPaymentExecute'))
            ->setCancelUrl(url("http://tagdv.vmclinic.in/membershipPaymentExecute"));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($apiContext);

        return redirect($payment->getApprovalLink());

    }


    public function membershipPaymentExecute(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdEXuIuVdlZIhhDfIlvmsBFdOPcCqmeUT6K6H5RslUOVzUeBwbFDz5S8rZN-Qiw8q4_Fe7r4bG_KVkLO',
                'EEqvrtJoBFYvWLzRxhpg3IlEg13nDDsPhP1toLm0V37NfQPxTZ23fiu0zNt38hCX4EGGhjpe6YEZMNxb'
            )
        );

        if (empty($request->paymentId) || empty($request->token) || empty($request->PayerID)) {

            return redirect(url("http://localhost:8000/membership"))->with('Membership', 'Payment Failed!..Please Try Again Later...');
        }


        if(!session()->has('Membership'))
        {
          return redirect(url("http://localhost:8000/membership"))->with('Membership', 'Payment Failed!..Please Try Again Later...');
        }
        
        $data=Session::get('Membership');

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal($data['membership_amount']);

        $amount->setCurrency('USD');
        $amount->setTotal($data['membership_amount']);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $apiContext);

        $payerDetails = $result->payer->payer_info;
        $transactionDetails = $result->transactions[0];


        if ($result->getState() == 'approved') {

        $payerInfo = $result->payer->payer_info;

            $payment = new Pay;
            $payment->Member_Id =$data['Member_Id'];;
            $payment->name =$payerInfo->first_name." ".$payerInfo->last_name;
            $payment->email =$data['email'];
            $payment->paypalEmail =$payerInfo->email;
            $payment->transactionId =$result->cart;
            $payment->purpose =$data['membership_code'];
            $payment->amount  =$transactionDetails->amount->total;
            $payment->amountType =$transactionDetails->amount->currency;
            $payment->status ="PAID";
            $payment->paymentDate =Carbon::now()->toDateString();
            $payment->save();

$email = Auth::user()->email;

            if($data['membership_code'] != "LM"){
                $yearEnd = date('Y-m-d', strtotime('Dec 31'));
            }else
            {
                $yearEnd = date('Y-m-d', strtotime('+10 years'));
            }

            $member=Member::where('primaryEmail',$email)->first();

            $membership = DB::table('members')
                ->where("primaryEmail", '=', $email)
                ->update(
                    ['membershipType'=> $data['membership_code'],
                    'membershipExpiryDate'=> $yearEnd]
                );


$member=Member::where('primaryEmail',Auth::user()->email)->first();
$user = Auth::user();
$sendMail=self::membership_email($user,$member,$payment);
        

        return redirect(url("http://localhost:8000/membership"))->with('Membership', 'Payment Success! Your membership details sent to your mail.');

        }else{
            return redirect(url("http://tagdv.vmclinic.in/membership"))->with('Membership', 'Payment Failed!..Please Try Again Later...');
        }
        
    }


public static function membership_email($user,$member,$payment)
{
    $subject = "Membership Payment";

    $name = $member['firstName']." ".$member['lastName'];
    $email = $member['primaryEmail'];

    Mail::send('mail.membershipSuccess', ['user' => $user,'member' => $member,'payment' => $payment], function ($message) use($subject,$name,$email)
    {
        $message->to($email, $name)->subject($subject);
    
    });
   return true;
}


    public function memberEventPaymentCreate(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdEXuIuVdlZIhhDfIlvmsBFdOPcCqmeUT6K6H5RslUOVzUeBwbFDz5S8rZN-Qiw8q4_Fe7r4bG_KVkLO',
                'EEqvrtJoBFYvWLzRxhpg3IlEg13nDDsPhP1toLm0V37NfQPxTZ23fiu0zNt38hCX4EGGhjpe6YEZMNxb'
            )
        );

        if(session()->has('EventTicket'))
        {
          $data=Session::get('EventTicket');  
        }
        else
        {
          Session::forget('EventTicket');
          return redirect('/nonMemberEventPaymentFailed');
        }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $count = count($data['ticketType']);
        

        for($i=0;$i<$count;$i++){
            if($data['ticketQty'][$i] > 0){
            $item[$i] = new Item();
            $item[$i]->setName($data['ticketType'][$i]."For ".$data['eventName'])
                ->setCurrency('USD')
                ->setQuantity($data['ticketQty'][$i])
                ->setPrice($data['ticketPrice'][$i]);
            }
        }
       //dd($item);
        $itemList = new ItemList();
        $itemList->setItems($item);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($data['totalAmount']);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($data['email'])
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('http://localhost:8000/memberEventPaymentExecute'))
            ->setCancelUrl(url("http://localhost:8000/memberEventPaymentExecute"));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($apiContext);

        return redirect($payment->getApprovalLink());

    }


    public function memberEventPaymentExecute(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdEXuIuVdlZIhhDfIlvmsBFdOPcCqmeUT6K6H5RslUOVzUeBwbFDz5S8rZN-Qiw8q4_Fe7r4bG_KVkLO',
                'EEqvrtJoBFYvWLzRxhpg3IlEg13nDDsPhP1toLm0V37NfQPxTZ23fiu0zNt38hCX4EGGhjpe6YEZMNxb'
            )
        );

        if (empty($request->paymentId) || empty($request->token) || empty($request->PayerID)) {

            return redirect(url("http://localhost:8000/memberTickets"))->with('Event', 'Payment Failed!..Please Try Again Later...');
        }


        if(!session()->has('EventTicket'))
        {
          return redirect(url("http://localhost:8000/memberTickets"))->with('Event', 'Payment Failed!..Please Try Again Later...');
        }
        
        $data=Session::get('EventTicket');
        $ticketCount = count($data['ticketType']);

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        // $details->setShipping(0)
        //         ->setTax(0)
        //         ->setSubtotal($data['totalAmount']);

        $amount->setCurrency('USD');
        $amount->setTotal($data['totalAmount']);
        //$amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $apiContext);

        $payerDetails = $result->payer->payer_info;
        $transactionDetails = $result->transactions[0];



        if ($result->getState() == 'approved') {

        $payerInfo = $result->payer->payer_info;

            $ticketPurchase = new TicketPurchase;
            $ticketPurchase->name = $data['firstName'].$data['lastName'];
            $ticketPurchase->email = $data['email'];
            $ticketPurchase->memberType = "Member";
            $ticketPurchase->Member_Id =$data['Member_Id'];
            $ticketPurchase->eventId = $data['eventId'];
            $ticketPurchase->eventName = $data['eventName'];
            $ticketPurchase->totalAmount = $data['totalAmount'];
            $ticketPurchase->paymentStatus = "COMP";
            $ticketPurchase->paymentId = $payerInfo->payer_id;
            $ticketPurchase->save();


            $lastInsert = TicketPurchase::whereRaw('id = (select max(`id`) from purchased_tickets)')->get();
                
            $lastInsertId = $lastInsert[0]['id'];

            for($i=0; $i<$ticketCount; $i++)
            {
                $ticketPurchaseDetail = new TicketPurchaseDetail;
                $ticketPurchaseDetail->ticketId =$lastInsertId;
                $ticketPurchaseDetail->ticketType =$data['ticketType'][$i];
                $ticketPurchaseDetail->ticketQty = $data['ticketQty'][$i];
                $ticketPurchaseDetail->ticketAmount = $data['ticketQty'][$i] * $data['ticketPrice'][$i];
                $ticketPurchaseDetail->save();
            }


            $payment = new Pay;
            $payment->Member_Id =$data['Member_Id'];;
            $payment->name =$payerInfo->first_name." ".$payerInfo->last_name;
            $payment->email =$data['email'];
            $payment->paypalEmail =$payerInfo->email;
            $payment->transactionId =$result->cart;
            $payment->purpose ="ET";
            $payment->amount  =$transactionDetails->amount->total;
            $payment->amountType =$transactionDetails->amount->currency;
            $payment->status ="PAID";
            $payment->paymentDate =Carbon::now()->toDateString();
            $payment->save();


    $member=Member::where('primaryEmail',Auth::user()->email)->first();
    $user = Auth::user();
    $sendMail=self::memberEventPaymentEmail($user,$member,$payment,$ticketPurchase);

        return redirect(url("http://localhost:8000/memberTickets"))->with('Event', 'Payment Success! Event ticket purchase details are sent to your mail.');

        }else{
            return redirect(url("http://localhost:8000/memberTickets"))->with('Event', 'Payment Failed!..Please Try Again Later...');
        }
        
    }


    public static function memberEventPaymentEmail($user,$member,$payment,$ticketPurchase)
    {
        $subject = "Event Ticket Purchase";

        $name = $member['firstName']." ".$member['lastName'];
        $email = $member['primaryEmail'];

        Mail::send('mail.memberEventPaymentEmail', ['user' => $user,'member' => $member,'payment' => $payment, 'ticketPurchase' => $ticketPurchase], function ($message) use($subject,$name,$email)
        {
            $message->to($email, $name)->subject($subject);
        
        });
       return true;
    }


    public function nonMemberEventPaymentCreate(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdEXuIuVdlZIhhDfIlvmsBFdOPcCqmeUT6K6H5RslUOVzUeBwbFDz5S8rZN-Qiw8q4_Fe7r4bG_KVkLO',
                'EEqvrtJoBFYvWLzRxhpg3IlEg13nDDsPhP1toLm0V37NfQPxTZ23fiu0zNt38hCX4EGGhjpe6YEZMNxb'
            )
        );

        if(session()->has('EventTicket'))
        {
          $data=Session::get('EventTicket');  
        }
        else
        {
          Session::forget('EventTicket');
          return redirect('/nonMemberEventPaymentFailed');
        }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $count = count($data['ticketType']);


        for($i=0;$i<$count;$i++){
            if($data['ticketQty'][$i] > 0){
            $item[$i] = new Item();
            $item[$i]->setName($data['ticketType'][$i]."For ".$data['eventName'])
                ->setCurrency('USD')
                ->setQuantity($data['ticketQty'][$i])
                ->setPrice($data['ticketPrice'][$i]);
            }
        }
       //dd($item);
        $itemList = new ItemList();
        $itemList->setItems($item);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($data['totalAmount']);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($data['email'])
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('http://tagdv.vmclinic.in/nonMemberEventPaymentExecute'))
            ->setCancelUrl(url("http://tagdv.vmclinic.in/nonMemberEventPaymentExecute"));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($apiContext);

        return redirect($payment->getApprovalLink());

    }


    public function nonMemberEventPaymentExecute(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AdEXuIuVdlZIhhDfIlvmsBFdOPcCqmeUT6K6H5RslUOVzUeBwbFDz5S8rZN-Qiw8q4_Fe7r4bG_KVkLO',
                'EEqvrtJoBFYvWLzRxhpg3IlEg13nDDsPhP1toLm0V37NfQPxTZ23fiu0zNt38hCX4EGGhjpe6YEZMNxb'
            )
        );
        
        if (empty($request->paymentId) || empty($request->token) || empty($request->PayerID)) {

            return redirect(url("http://tagdv.vmclinic.in/nonMemberTicket"))->with('Event', 'Payment Failed!..Please Try Again Later...');
        }


        if(!session()->has('EventTicket'))
        {
          return redirect(url("http://tagdv.vmclinic.in/nonMemberTicket"))->with('Event', 'Payment Failed!..Please Try Again Later...');
        }
        
        $data=Session::get('EventTicket');
        $ticketCount = count($data['ticketType']);

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        // $details->setShipping(0)
        //         ->setTax(0)
        //         ->setSubtotal($data['totalAmount']);

        $amount->setCurrency('USD');
        $amount->setTotal($data['totalAmount']);
        //$amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        $result = $payment->execute($execution, $apiContext);

        $payerDetails = $result->payer->payer_info;
        $transactionDetails = $result->transactions[0];



        if ($result->getState() == 'approved') {

        $payerInfo = $result->payer->payer_info;

            $nonMember = new nonMember;
            $nonMember->firstName = $data['firstName'];
            $nonMember->lastName = $data['lastName'];
            $nonMember->email = $data['email'];
            $nonMember->phoneNo = $data['phoneNo'];
            $nonMember->save();

            $ticketPurchase = new TicketPurchase;
            $ticketPurchase->name = $data['firstName'].$data['lastName'];
            $ticketPurchase->email = $data['email'];
            $ticketPurchase->memberType = "Non Member";
            $ticketPurchase->Member_Id ="Non Member";
            $ticketPurchase->eventId = $data['eventId'];
            $ticketPurchase->eventName = $data['eventName'];
            $ticketPurchase->totalAmount = $data['totalAmount'];
            $ticketPurchase->paymentStatus = "COMP";
            $ticketPurchase->paymentId = $payerInfo->payer_id;
            $ticketPurchase->save();


            $lastInsert = TicketPurchase::whereRaw('id = (select max(`id`) from purchased_tickets)')->get();
                
            $lastInsertId = $lastInsert[0]['id'];

            for($i=0; $i<$ticketCount; $i++)
            {
                $ticketPurchaseDetail = new TicketPurchaseDetail;
                $ticketPurchaseDetail->ticketId =$lastInsertId;
                $ticketPurchaseDetail->ticketType =$data['ticketType'][$i];
                $ticketPurchaseDetail->ticketQty = $data['ticketQty'][$i];
                $ticketPurchaseDetail->ticketAmount = $data['ticketQty'][$i] * $data['ticketPrice'][$i];
                $ticketPurchaseDetail->save();
            }


            $payment = new Pay;
            $payment->Member_Id ="Non Member";
            $payment->name =$payerInfo->first_name." ".$payerInfo->last_name;
            $payment->email =$data['email'];
            $payment->paypalEmail =$payerInfo->email;
            $payment->transactionId =$result->cart;
            $payment->purpose ="ET";
            $payment->amount  =$transactionDetails->amount->total;
            $payment->amountType =$transactionDetails->amount->currency;
            $payment->status ="PAID";
            $payment->paymentDate =Carbon::now()->toDateString();
            $payment->save();


        $user = $nonMember;
        $sendMail=self::nonMemberEventPaymentEmail($nonMember,$payment,$ticketPurchase);

        return redirect(url("http://tagdv.vmclinic.in/nonMemberTicket"))->with('Event', 'Payment Success! Event ticket purchase details are sent to your mail.');

        }else{
            return redirect(url("http://tagdv.vmclinic.in/nonMemberTicket"))->with('Event', 'Payment Failed!..Please Try Again Later...');
        }
        
    }


    public static function nonMemberEventPaymentEmail($nonMember,$payment,$ticketPurchase)
    {
        $subject = "Event Ticket Purchase";
        $email = $nonMember['email'];
        $firstName = $nonMember['firstName'];
        $lastName = $nonMember['lastName'];
        $name = $firstName." ".$lastName;

        Mail::send('mail.nonMemberEventPaymentEmail', ['nonMember' => $nonMember,'payment' => $payment, 'ticketPurchase' => $ticketPurchase], function ($message) use($email,$name,$subject)
        {

            $message->to($email, $name)->subject($subject);
        
        });
       return true;
    }







}
