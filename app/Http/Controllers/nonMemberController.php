<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Event;
use App\EventTicket;
use DB;
use App\NonMember;
use App\TicketPurchase;
use App\TicketPurchaseDetail;

class nonMemberController extends Controller
{
    public function nonMemberTicket()
    {
    	$baseurl = Storage::url('upload/events/');
    	$events = Event::all()->toArray();
        return view('nonMemberTicket',compact('baseurl','events'));
    }

    public function nonMemberBuyTicket($id)
    {
    	$nonMemberTickets = EventTicket::where('eventId',"=", $id)->where('memberType',"=", 'nonmember')->get();

        return view('nonMemberBuyTicket',compact('nonMemberTickets'));
    }

    public function nonMemberBuyTicketPost(Request $request)
    {

        $nonMember = new nonMember;
        $nonMember->firstName = $request->firstName;
        $nonMember->lastName = $request->lastName;
        $nonMember->email = $request->email;
        $nonMember->phoneNo = $request->phoneNo;
        $nonMember->save();


        $ticketCount = count($request->ticketType);

        $totalAmount = "";
        $allData = $request->all();

        for($i=0; $i<$ticketCount; $i++){
          
          $totalAmount += $allData['ticketQty'][$i] * $allData['ticketPrice'][$i];        
        } 


            $ticketPurchase = new TicketPurchase;
            $ticketPurchase->name = $allData['firstName'].$allData['lastName'];
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
}
