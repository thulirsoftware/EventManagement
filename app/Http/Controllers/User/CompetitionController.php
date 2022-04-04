<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\EventTicket;
use App\EventEntryTickets;
use Carbon\Carbon;
use Auth;
use App\PurchasedEventEntryTickets;
use Session;
use App\PurchasedEventFoodTickets;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\FamilyMember;
use App\EventCompetition;
use App\Competition;
use App\GroupNames;
use App\Event;
use App\CompetitionRegistered;

class CompetitionController extends Controller
{
    public function MemberCompetitionShow(Request $request)
    {
        $allData = Session::get('foodTickets');
         $entryData = Session::get('entryTickets');
         $competitionData =null;
        if(isset($allData['ticketType']))
        {
            $result = array_filter($allData['ticketType']);  
            $foodticketCount = count($result); 
        }
        else
        {
             $foodticketCount = 0;
        }
        if(isset($entryData['ticketType']))
        {
            $result = array_filter($entryData['ticketType']);
            $ticketCount = count($result); 
        }
        else
        {
             $ticketCount = 0;
        }
       
        $totalAmount = 0;
        $FoodAmount = 0;
        $EntryTicketAmounts =0;
        for($i=0; $i<$ticketCount; $i++){
        $EntryTicketAmounts += (intval($entryData['ticketQty'][$i])) * (intval($entryData['ticketPrice'][$i])); 
        }

        for($i=0; $i<$foodticketCount; $i++){
        $FoodAmount += (intval($allData['ticketQty'][$i])) * (intval($allData['ticketPrice'][$i])); 
        }
         $totalAmount = $EntryTicketAmounts+$FoodAmount;
            $compeitionAmounts = "0";
        $eventName = "";
        if(isset($allData['FoodTicketId']))
        {
            $foodTickets = EventTicket::where('id',$allData['FoodTicketId'])->get(); 
        }
        else
        {
             $foodTickets = [];
        }
        if(isset($entryData['EntryTicketId']))
        {
            $entryTickets = EventEntryTickets::where('id',$entryData['EntryTicketId'])->get(); 
        }
        else
        {
            $entryTickets = [];
        }
        
        if(isset($foodData['ticketQty']))
        {
            $totalFoodticket = array_sum(array_filter($foodData['ticketQty'])); 
        }
        else
        {
            $totalFoodticket = 0;
        }
        if(isset($entryData['ticketQty']))
        {
            $totalEntryticket = array_sum(array_filter($entryData['ticketQty']));
        }
        else
        {
            $totalEntryticket = 0;
        }
        

        return view('user.view_purchased_amount_details',compact('totalAmount','eventName','ticketCount','foodticketCount','EntryTicketAmounts','FoodAmount','compeitionAmounts','foodTickets','entryTickets','totalEntryticket','totalFoodticket','competitionData'));
        
    }

    public function getCompetition($id, Request $request)
    {
         $tagDvId = Auth::user()->Member_Id;

        $familyMembers = FamilyMember::where('Member_Id',$tagDvId)->get();
        $familyMember_list = FamilyMember::where('Member_Id',$tagDvId)->get();
        $EventCompetition = EventCompetition::where('event_id',$id)->where('status','Y')->pluck('competition_id');
        $EventCompetitionAJax = EventCompetition::where('status','Y')->get();
        $Competition = Competition::whereIn('id',$EventCompetition)->get();
        $MembersAjax = Member::get();
        $familyMembersAjax = FamilyMember::where('user_id',Auth::user()->id)->get();
        $CompetitionAjax = Competition::whereIn('id',$EventCompetition)->get();
        $CompetitionAjax2 = Competition::whereIn('id',$EventCompetition)->get();
        return view('user.ticketBuy.competition_add',compact('familyMembers','Competition','EventCompetitionAJax','familyMember_list','MembersAjax','familyMembersAjax','id','CompetitionAjax','CompetitionAjax2'));
       
    }

    public function saveGroup(Request $request)
    {
        $groups = new GroupNames();
        $groups->user_id = Auth::user()->id;
        $groups->event_id = $request->modal_event_id;
        $groups->competition_id = $request->modal_competition_id;
        $groups->name = $request->group_name;
        $groups->description = $request->group_description;
        $groups->no_of_participants = $request->no_of_participants;
        $groups->save();

        return redirect()->back()->withSuccess('Group Added Successfully');

    }

    public function listGroupParticipants(Request $request)
    {
        $groups = GroupNames::where('user_id',Auth::user()->id)->where('event_id',$request->eventId)->where('competition_id',$request->id)->get();
        return response($groups, 200);
    }
     public function listsoloParticipants(Request $request)
    {
        $groups = GroupNames::where('user_id',Auth::user()->id)->where('event_id',$request->eventId)->where('competition_id',$request->id)->get();
        return response($groups, 200);
    }

    public function SaveCompetition(Request $request)
    {
        Session::put('CompetitionStore',$request->all());
        $allData = $request->all();
        Session::put('TicketStore', $allData);
        return redirect('/tickets/competition/show/payment');
    }

    public function competitionPayment(Request $request)
    {
        $entryData = Session::get('entryTickets');
        $foodData = Session::get('foodTickets');
        $competitionData = Session::get('CompetitionStore');
        $EntryTicketAmounts = 0;
        $totalAmounts =0;
        $FoodAmount =0;
        $compeitionAmounts =0;

        if(isset($foodData['ticketType']))
        {
             $foodticketCount = count($foodData['ticketType']);
        }
        else
        {
             $foodticketCount = 0;
        }
        if(isset($entryData['ticketType']))
        {
             $ticketCount = count($entryData['ticketType']);
        }
        else
        {
             $ticketCount = 0;
        }
        if(isset($foodData['FoodTicketId']))
        {
            $foodTickets = EventTicket::where('id',$foodData['FoodTicketId'])->get(); 
        }
        else
        {
             $foodTickets = [];
        }
        if(isset($entryData['EntryTicketId']))
        {
            $entryTickets = EventEntryTickets::where('id',$entryData['EntryTicketId'])->get(); 
        }
        else
        {
            $entryTickets = [];
        }
           
            $totalAmount = 0;
            $FoodAmount = 0;
            $EntryTicketAmounts =0;
            
            for($i=0; $i<$ticketCount; $i++){
            $EntryTicketAmounts += (intval($entryData['ticketQty'][$i])) * (intval($entryData['ticketPrice'][$i])); 
            }
            for($i=0; $i<$foodticketCount; $i++){
            $FoodAmount += (intval($foodData['ticketQty'][$i])) * (intval($foodData['ticketPrice'][$i])); 
            }
            $tmember_feeCount = count($competitionData['member_fee']); 
            for($i=0; $i<$tmember_feeCount; $i++)
            {
                $compeitionAmounts += (intval($competitionData['member_fee'][$i])); 
            }
            $totalAmount = $EntryTicketAmounts+$FoodAmount+$compeitionAmounts;
            $events = Event::where('id', $entryData['eventId'])->first();
            Session::put('Events', $events);
        if(isset($foodData['ticketQty']))
        {
            $totalFoodticket = array_sum(array_filter($foodData['ticketQty'])); 
        }
        else
        {
            $totalFoodticket = 0;
        }
        if(isset($entryData['ticketQty']))
        {
            $totalEntryticket = array_sum(array_filter($entryData['ticketQty']));
        }
        else
        {
            $totalEntryticket = 0;
        }
        
     
         $eventName="";
        return view('user.view_purchased_amount_details',compact('totalAmount','eventName','ticketCount','foodticketCount','EntryTicketAmounts','FoodAmount','compeitionAmounts','foodTickets','entryTickets','totalEntryticket','totalFoodticket','competitionData','tmember_feeCount'));
        
    }

    public function listParticipants(Request $request)
    {
         $groups = CompetitionRegistered::where('user_id',Auth::user()->id)->where('event_id',$request->eventId)->where('competition_id',$request->id)->get();
         $collection = $groups->map(function ($item) {
            $group = GroupNames::where('id',$item->group_id)->first();
            $item->group_name = $group->name;
         });
        return response($groups, 200);
    }

    
}
