<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Storage;
use App\Event;
use App\EventTicket;
use Auth;
use App\TicketPurchase;
use App\TicketPurchaseDetail;

class MemberController extends Controller
{
 
    public function memberTickets()
    {
        $baseurl = Storage::url('upload/events/');
        $events = Event::all()->toArray();
        return view('user.memberTickets',compact('baseurl','events'));
    }

    public function memberBuyTicket($id)
    {
        $memberTickets = EventTicket::where('eventId',"=", $id)->where('memberType',"=", 'member')->get();

        $user = Auth::user();

        return view('user.memberBuyTicket',compact('memberTickets','user'));
    }

    public function memberBuyTicketPost(Request $request)
    {

    $ticketCount = count($request->ticketType);

    $allData = $request->all();

    $totalAmount = "";

    for($i=0; $i<$ticketCount; $i++){
      
      $totalAmount += $allData['ticketQty'][$i] * $allData['ticketPrice'][$i];        
    } 

            $ticketPurchase = new TicketPurchase;
            $ticketPurchase->name = $allData['name'];
            $ticketPurchase->email = $allData['email'];
            $ticketPurchase->memberType = $allData['memberType'];
            $ticketPurchase->tagDvId =$allData['tagDvId'];
            $ticketPurchase->eventId = $allData['eventId'];
            $ticketPurchase->eventName = $allData['eventName'];
            $ticketPurchase->totalAmount = $totalAmount;
            $ticketPurchase->paymentStatus = "PEND";
            $ticketPurchase->paymentId = "";
            $ticketPurchase->save();

    $lastInsert = TicketPurchase::whereRaw('id = (select max(`id`) from purchased_tickets)')->get();

    $lastInsertId = $lastInsert[0]['id'];

        for($i=0; $i<$ticketCount; $i++){

            $ticketPurchaseDetail = new TicketPurchaseDetail;
            $ticketPurchaseDetail->ticketId =$lastInsertId;
            $ticketPurchaseDetail->ticketType =$allData['ticketType'][$i];
            $ticketPurchaseDetail->ticketQty = $allData['ticketQty'][$i];
            $ticketPurchaseDetail->ticketAmount = $allData['ticketQty'][$i] * $allData['ticketPrice'][$i];
            $ticketPurchaseDetail->save();
                
        }       

        return redirect()->back();
    }



    















     public function purchase_event_tickets()
        {
            return view('user.purchase_event_tickets');
        }

        public function user_home()
        {
            return view('user.user_home');
        }

        public function renew_membership()
        {
            return view('user.renew_membership');
        }
        public function edit_profile()
        {
            return view('user.edit_profile');
        }
       
        public function edit_members()
        {
            return view('user.edit_members');
        }
}
