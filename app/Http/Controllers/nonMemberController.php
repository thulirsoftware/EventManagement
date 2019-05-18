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
use Session;

class nonMemberController extends Controller
{
    


    public function nonMemberTicket()
    {
     	$events = Event::all()->toArray();

        foreach($events as $key=>$value){
            $eventId = $value['id'];
            
            $events[$key]['nonMemberTicketsCount'] = count(EventTicket::where('eventId',"=", $eventId)->where('memberType',"=", 'nonmember')->get());
            $events[$key]['memberTicketsCount'] = count(EventTicket::where('eventId',"=", $eventId)->where('memberType',"=", 'nonmember')->get());
        }

        $baseurl = "/events/";
    	
        return view('nonMemberTicket',compact('baseurl','events'));
    }



    public function nonMemberBuyTicket($id)
    {
    	$nonMemberTickets = EventTicket::where('eventId',"=", $id)->where('memberType',"=", 'nonmember')->get();

        return view('nonMemberBuyTicket',compact('nonMemberTickets'));
    }
    

    
    public function nonMemberBuyTicketPost(Request $request)
    {

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $email = $request->email;
        $phoneNo = $request->phoneNo;
        $tagDvId = $request->tagDvId;
        $eventId = $request->eventId;
        $eventName = $request->eventName;
        $memberType = $request->memberType;
        $ticketQty = $request->ticketQty;
        $ticketType = $request->ticketType;
        $ticketPrice = $request->ticketPrice;

        $ticketCount = count($request->ticketType);

        $totalAmount = 0;
        $allData = $request->all();

        for($i=0; $i<$ticketCount; $i++){
        $totalAmount += (intval($allData['ticketQty'][$i])) * (intval($allData['ticketPrice'][$i])); 
        } 
        
        if ($totalAmount < 1) {
            return redirect()->back()->with('Error', 'Total ticket quantity must be greater than 1!');
        }
        
        //dd($totalAmount);
        $request['totalAmount'] = $totalAmount;

        // Session Put
        $sessionData = $request->all();
        Session::put('EventTicket',$sessionData);

        return view('nonMemberTicketView',compact('ticketQty','ticketType','ticketPrice','sessionData'));
    }
}
