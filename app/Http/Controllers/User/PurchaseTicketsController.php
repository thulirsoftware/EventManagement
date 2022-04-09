<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Member;
use App\EventTicket;
use App\EventEntryTickets;
use Carbon\Carbon;
use Auth;
use App\PurchasedEventEntryTickets;
use Session;
use App\PurchasedEventFoodTickets;
use App\EventCompetition;
use App\TicketPurchase;
use App\EventRegistration;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\CompetitionRegistered;

class PurchaseTicketsController extends Controller
{
    public function memberBuyTicket($id)
    {
        $events = Event::where('id', $id)->first();
        $this_year = date('Y-m-d');
        $Member = Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
        if($Member!=null)
         {
            $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'member')->get();

            $memberEventTicketCount = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'member')->where('status','Y')->count();
         }
         else
         {
         $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'NonMember')->get();

          $memberEventTicketCount = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'NonMember')->where('status','Y')->count();
         }
         $todayDate =Carbon::now()->toDateString();
         $Purchasedentrytickets = PurchasedEventEntryTickets::where('eventId', $id)->where('userId',Auth::user()->id)->where('ticketQty','!=',null)->get();
        return view('user.ticketBuy.entryticketlist',compact('events','memberEventTickets','id','todayDate','Purchasedentrytickets','memberEventTicketCount'));
    }
    public function saveEntryTicket(Request $request)
    {
        Session::put('entryTickets', $request->all());
        return redirect('/tickets/get/food/'.$request->eventId);
    }


    /********** Food Ticket Purchase *********/

    public function getFoodTicket($id)
    {
        $events = Event::where('id', $id)->first();
        $this_year = Carbon::now()->format('Y-m-d');
        $Member = Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
         if($Member!=null)
         {
            $memberTickets = EventTicket::where('eventId', $id)->where('memberType','member')->get();
            $memberTicketCount = EventTicket::where('eventId',$id)->where('memberType',"=", 'member')->where('status','Y')->count();
         }
         else
         {
            $memberTickets = EventTicket::where('eventId', $id)->where('memberType','NonMember')->get();
            $memberTicketCount = EventTicket::where('eventId',$id)->where('memberType',"=", 'NonMember')->where('status','Y')->count();
         }
         $todayDate =Carbon::now()->toDateString();
         $Purchasedfoodtickets = PurchasedEventFoodTickets::where('eventId', $id)->where('userId',Auth::user()->id)->where('ticketQty','!=',null)->get();
         $competitionCount = EventCompetition::where('event_id',$id)->where('competition_id','!=',NULL)->where('status','Y')->count();
        return view('user.ticketBuy.foodticketlist',compact('events','memberTickets','id','todayDate','Purchasedfoodtickets','competitionCount','memberTicketCount'));
    }

    public function saveFoodTicket(Request $request)
    {
        $entry = Session::get('entryTickets');
        
        if($request->minimal=="no")
        {
            if(isset($request->ticketQty))
            {
                                $array = array_filter($request->ticketQty, function($a) {return $a !==null;});

                $foodticketCount = count($array); 
            }
            else
            {
                 $foodticketCount = 0;
            }
            if(isset($entry->ticketQty))
            {
                $array = array_filter($entry->ticketQty, function($a) {return $a !==null;});

                $ticketCount = count($array); 
            }
            else
            {
                 $ticketCount = 0;
            }
           
            $totalAmount = 0;
            $FoodAmount = 0;
            $EntryTicketAmounts =0;
            $allData = $request->all();
            Session::put('TicketStore', $allData);
            for($i=0; $i<$ticketCount; $i++){
            $EntryTicketAmounts += (intval($entry['ticketQty'][$i])) * (intval($entry['ticketPrice'][$i])); 
            }
            for($i=0; $i<$foodticketCount; $i++){
            $FoodAmount += (intval($allData['ticketQty'][$i])) * (intval($allData['ticketQty'][$i])); 
            }
             $totalAmount = $EntryTicketAmounts+$FoodAmount;
            $compeitionAmounts = "0";
            $events = Event::where('id', $request->eventId)->first();
            Session::put('Events', $events);
            Session::put('foodTickets', $request->all());
             $competitionStore = Session::get('foodTickets');
            return redirect('/MemberCompetitionget');
        }
        else
        {
            Session::put('foodTickets', $request->all());
            return redirect('/tickets/competition/add/'.$request->eventId);
        }
    }

    public function memberTicketAmountPay(Request $req)
    {
        $user = Auth::user();
        $request = Session::get('entryTickets');
        $foodTickets = Session::get('foodTickets');
        $CompetitionStore = Session::get('CompetitionStore');//need to add
        if(isset($foodTickets['ticketType']))
        {
             $foodticketCount = count($foodTickets['ticketType']);
        }
        else
        {
             $foodticketCount = 0;
        }
        if(isset($request['ticketType']))
        {
             $ticketCount = count($request['ticketType']);
        }
        else
        {
             $ticketCount = 0;
        }
       if(isset($CompetitionStore['competition_id']))
        {
             $competition_idCount = count($CompetitionStore['competition_id']);
        }
        else
        {
             $competition_idCount = 0;
        }

       

        $totalAmount = 0;
        $totalAmounts =0;
        $compeitionAmounts =0;

        for($i=0; $i<$ticketCount; $i++){
        $totalAmount += (intval($request['ticketQty'][$i])) * (intval($request['ticketPrice'][$i])); 
                }
        for($i=0; $i<$foodticketCount; $i++){
        $totalAmounts += (intval($foodTickets['ticketQty'][$i])) * (intval($foodTickets['ticketPrice'][$i])); 
        }
          for($i=0; $i<$competition_idCount; $i++){
                $totalAmounts += (intval($CompetitionStore['member_fee'][$i])); 
                }
        $totalAmount = $totalAmount+$totalAmounts;

       if ($totalAmount <=0) 
        {
                for($i = 0;$i < $ticketCount; $i++)
                {
                    if($request['ticketQty'][$i]!=null)
                    {
                        $PurchasedEventEntryTickets = new PurchasedEventEntryTickets();
                        $PurchasedEventEntryTickets->eventId = $request['eventId'];
                        $PurchasedEventEntryTickets->userId = auth()->user()->id;
                        $PurchasedEventEntryTickets->ticketId = $request['EntryTicketId'][$i];
                        $PurchasedEventEntryTickets->ticketQty = $request['ticketQty'][$i];
                        $PurchasedEventEntryTickets->ticketAmount = $request['ticketPrice'][$i];
                        $PurchasedEventEntryTickets->save();
                    }
                }
                
    
                for($i = 0;$i < $foodticketCount; $i++)
                {
                     if($foodTickets['ticketQty'][$i]!=null)
                    {
                        $PurchasedEventFoodTickets = new PurchasedEventFoodTickets();
                        $PurchasedEventFoodTickets->eventId = $request['eventId'];
                        $PurchasedEventFoodTickets->userId = auth()->user()->id;
                        $PurchasedEventFoodTickets->ticketId = $foodTickets['FoodTicketId'][$i];
                        $PurchasedEventFoodTickets->ticketQty = $foodTickets['ticketQty'][$i];
                        $PurchasedEventFoodTickets->ticketAmount = $foodTickets['ticketPrice'][$i];
                        $PurchasedEventFoodTickets->save();
                    }
                }
            
    
                for($i = 0;$i < $competition_idCount; $i++)
                {
                    $CompetitionRegistered = new CompetitionRegistered();
                    $CompetitionRegistered->event_id =  $request['eventId'];
                    $CompetitionRegistered->participant_id = $CompetitionStore['participant_id'][$i];
                    $CompetitionRegistered->competition_id = $CompetitionStore['competition_id'][$i];
                    $CompetitionRegistered->fees = $CompetitionStore['member_fee'][$i];
                    $CompetitionRegistered->user_id = Auth::user()->id;
                
                    $CompetitionRegistered->first_name = $CompetitionStore['first_name'][$i];
    
                    $CompetitionRegistered->last_name = $CompetitionStore['last_name'][$i];
                    $CompetitionRegistered->age = $CompetitionStore['age'][$i];
                    if(isset($CompetitionStore['group_id']))
                    {
                    $CompetitionRegistered->group_id = $CompetitionStore['group_id'][$i];
                      }              
                    $CompetitionRegistered->save();
                }
                $TicketPurchase = new TicketPurchase();
                $TicketPurchase->name = $user->name;
                $TicketPurchase->email = $user->email;
                $TicketPurchase->eventId = $request['eventId'];
                $TicketPurchase->totalAmount = $totalAmount;
                $TicketPurchase->payment_type = $req['payment_type'];
                $TicketPurchase->user_id = Auth::user()->id;
                $TicketPurchase->paymentStatus = 'approved';
                $TicketPurchase->save();
    
                $EventRegistration = new EventRegistration();
                $EventRegistration->user_id = Auth::user()->id;
                $EventRegistration->event_id = $request['eventId'];
                $EventRegistration->save();
                
                 
                \Mail::send('emails.event_registration_email', ['ticketPurchase' => $TicketPurchase], function($message) use($request){

                          $message->to(Auth::user()->email);
            
                          $message->subject('Event Registration Payment');
            
                      });
                      
                   return redirect('/memberTickets')->withSuccess('Ticket Purchased Successfully');
        }
        else
        {
            $request['totalAmount'] = $totalAmount;

       
        
            for($i = 0;$i < $ticketCount; $i++)
            {
                if($request['ticketQty'][$i]!=null)
                {
                    $PurchasedEventEntryTickets = new PurchasedEventEntryTickets();
                    $PurchasedEventEntryTickets->eventId = $request['eventId'];
                    $PurchasedEventEntryTickets->userId = auth()->user()->id;
                    $PurchasedEventEntryTickets->ticketId = $request['EntryTicketId'][$i];
                    $PurchasedEventEntryTickets->ticketQty = $request['ticketQty'][$i];
                    $PurchasedEventEntryTickets->ticketAmount = $request['ticketPrice'][$i];
                    $PurchasedEventEntryTickets->save();
                }
            }
            

            for($i = 0;$i < $foodticketCount; $i++)
            {
                 if($foodTickets['ticketQty'][$i]!=null)
                {
                    $PurchasedEventFoodTickets = new PurchasedEventFoodTickets();
                    $PurchasedEventFoodTickets->eventId = $request['eventId'];
                    $PurchasedEventFoodTickets->userId = auth()->user()->id;
                    $PurchasedEventFoodTickets->ticketId = $foodTickets['FoodTicketId'][$i];
                    $PurchasedEventFoodTickets->ticketQty = $foodTickets['ticketQty'][$i];
                    $PurchasedEventFoodTickets->ticketAmount = $foodTickets['ticketPrice'][$i];
                    $PurchasedEventFoodTickets->save();
                }
            }
        

            for($i = 0;$i < $competition_idCount; $i++)
            {
                $CompetitionRegistered = new CompetitionRegistered();
                $CompetitionRegistered->event_id =  $request['eventId'];
                $CompetitionRegistered->participant_id = $CompetitionStore['participant_id'][$i];
                $CompetitionRegistered->competition_id = $CompetitionStore['competition_id'][$i];
                $CompetitionRegistered->fees = $CompetitionStore['member_fee'][$i];
                $CompetitionRegistered->user_id = Auth::user()->id;
            
                $CompetitionRegistered->first_name = $CompetitionStore['first_name'][$i];

                $CompetitionRegistered->last_name = $CompetitionStore['last_name'][$i];
                $CompetitionRegistered->age = $CompetitionStore['age'][$i];
                if(isset($CompetitionStore['group_id']))
                {
                $CompetitionRegistered->group_id = $CompetitionStore['group_id'][$i];
                  }              
                $CompetitionRegistered->save();
            }
            $TicketPurchase = new TicketPurchase();
            $TicketPurchase->name = $user->name;
            $TicketPurchase->email = $user->email;
            $TicketPurchase->eventId = $request['eventId'];
            $TicketPurchase->totalAmount = $totalAmount;
            $TicketPurchase->payment_type = $req['payment_type'];
            $TicketPurchase->user_id = Auth::user()->id;
            $TicketPurchase->save();
            Session::put('paymentId',$TicketPurchase->id);

            $EventRegistration = new EventRegistration();
            $EventRegistration->user_id = Auth::user()->id;
            $EventRegistration->event_id = $request['eventId'];
            $EventRegistration->save();
            
           
           return redirect('/memberpaymentComplete');
        }

    }

    

}
