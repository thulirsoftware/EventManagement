<?php

namespace App\Http\Controllers;
use App\NonMember;
use App\FamilyMember;
use App\Member;
use Illuminate\Http\Request;
use Storage;
use App\Event;
use App\EventTicket;
use App\EventEntryTickets;
use Auth;
use App\TicketPurchase;
use App\TicketPurchaseDetail;
use App\PurchasedEventEntryTickets;
use App\PurchasedEventFoodTickets;
use Session;
use DB;
use App\User;
use Carbon\Carbon;
use App\MembershipBuy;
use App\EventCompetition;
use App\Competition;
use App\CompetitionRegistered;

class MemberController extends Controller
{
 
    public function memberTickets()
    {
        
        $toDay =Carbon::now()->toDateString();
        $EventCompetition = CompetitionRegistered::pluck('event_id');

        $events = Event::whereNotIn('id',$EventCompetition)->where('eventDate','>=',$toDay)->get();
       
        return view('user.memberTickets',compact('events'));
    }

    public function memberBuyTicket($id)
    {
        $events = Event::where('id', $id)->first();
        $memberTickets = EventTicket::where('eventId', $id)->where('memberType','member')->get();
         $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'member')->get();
        $member = Auth::user()->email;
        $user = Member::where('Email_Id',$member)->get();
        $todayDate =Carbon::now()->toDateString();
        return view('user.memberBuyTicket',compact('memberTickets','user','todayDate','memberEventTickets','events','id'));
    }
    

    public function memberBuyTicketPost(Request $request)
    {
       if($request->minimal=="no")
       {
        if($request->has('FoodticketType'))
        {
            $foodticketCount = count($request->FoodticketType); 
        }
        else
        {
             $foodticketCount = 0;
        }
        if($request->has('ticketType'))
        {
            $ticketCount = count($request->ticketType); 
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
        $EntryTicketAmounts += (intval($allData['ticketQty'][$i])) * (intval($allData['ticketPrice'][$i])); 
        }
        for($i=0; $i<$foodticketCount; $i++){
        $FoodAmount += (intval($allData['FoodticketQty'][$i])) * (intval($allData['FoodticketPrice'][$i])); 
        }
         $totalAmount = $EntryTicketAmounts+$FoodAmount;
        $eventName = $request->eventName;
        $compeitionAmounts = "0";
        return view('user.view_purchased_amount_details',compact('totalAmount','eventName','ticketCount','foodticketCount','EntryTicketAmounts','FoodAmount','compeitionAmounts'));
    }
    else
    {
        $allData = $request->all();
        Session::put('TicketStore', $allData);
        $events = Event::where('id', $request->eventId)->first();
        Session::put('Events', $events);
        return redirect('/memberAddCompetition/'.$request->eventId);

    }
    }
    public function memberAddCompetition($id)
    {
       $tagDvId = Auth::user()->Member_Id;

        $familyMembers = FamilyMember::where('Member_Id',$tagDvId)->get();
        $familyMember_list = FamilyMember::where('Member_Id',$tagDvId)->get();
        $EventCompetition = EventCompetition::where('event_id',$id)->pluck('competition_id');
        $EventCompetitionAJax = EventCompetition::get();
        $Competition = Competition::whereIn('id',$EventCompetition)->get();
        $MembersAjax = Member::get();
        $familyMembersAjax = FamilyMember::get();
        return view('user.competition_register',compact('familyMembers','Competition','EventCompetitionAJax','familyMember_list','MembersAjax','familyMembersAjax'));
    }
    public function MemberCompetitionPost(Request $request)
    {
        $request = $request->all();
        Session::put('CompetitionStore', $request);
        $totalAmount = 0;
        $FoodAmount = 0;
        $EntryTicketAmounts =0;
        $compeitionAmounts =0;
        if(Session::get('TicketStore')!=null)
        {
                $allData = Session::get('TicketStore');
                
                if(isset($allData['FoodticketType']))
                {
                     $foodticketCount = count($allData['FoodticketType']);
                }
                else
                {
                     $foodticketCount = 0;
                }
                if(isset($allData['ticketType']))
                {
                     $ticketCount = count($allData['ticketType']);
                }
                else
                {
                     $ticketCount = 0;
                }
                for($i=0; $i<$ticketCount; $i++){
                $EntryTicketAmounts += (intval($allData['ticketQty'][$i])) * (intval($allData['ticketPrice'][$i])); 
                }
                for($i=0; $i<$foodticketCount; $i++){
                $FoodAmount += (intval($allData['FoodticketQty'][$i])) * (intval($allData['FoodticketPrice'][$i])); 
                }
                if(isset($request['member_fee']))
                {
                     $tmember_feeCount = count($request['member_fee']);
                }
                else
                {
                     $tmember_feeCount = 0;
                }
               // $tmember_feeCount = count($request['member_fee']); 
                for($i=0; $i<$tmember_feeCount; $i++){
                $compeitionAmounts += (intval($request['member_fee'][$i])); 
                }
                

                $totalAmount = $EntryTicketAmounts+$FoodAmount+$compeitionAmounts;
                $eventName = "";
                
        }
        else
        {
           
                $tmember_feeCount = count($allData->member_fee); 
                for($i=0; $i<$tmember_feeCount; $i++){
                $EntryTicketAmounts += (intval($allData['member_fee'][$i])) * (intval($allData['member_fee'][$i+1])); 
                }
                
                $totalAmount = $EntryTicketAmounts;

        }
        return view('user.view_purchased_amount_details',compact('totalAmount','eventName','ticketCount','foodticketCount','EntryTicketAmounts','FoodAmount','compeitionAmounts'));
    }
    public function memberTicketAmountPay(Request $request)
    {
        
        $request = Session::get('TicketStore');
        $CompetitionStore = Session::get('CompetitionStore');
        if(isset($request['FoodticketType']))
        {
             $foodticketCount = count($request['FoodticketType']);
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
        $totalAmounts += (intval($request['FoodticketQty'][$i])) * (intval($request['FoodticketPrice'][$i])); 
        }
                for($i=0; $i<$competition_idCount; $i++){
                $compeitionAmounts += (intval($CompetitionStore['member_fee'][$i])); 
                }
        $totalAmount = $totalAmount+$totalAmounts+$compeitionAmounts;

        if ($totalAmount < 1) {
            return redirect()->back()->with('Error', 'Total ticket quantity must be greater than 1!');
        }

        $request['totalAmount'] = $totalAmount;

        $TicketPurchase = new TicketPurchase();
        $TicketPurchase->name = $request['firstName'];
        $TicketPurchase->email = $request['email'];
        $TicketPurchase->eventId = $request['eventId'];
        $TicketPurchase->eventName = $request['eventName'];
        $TicketPurchase->totalAmount = $totalAmount;
        $TicketPurchase->save();
        if(isset($request['EntryTicketId']))
        {
             $EventEntryTickets_count = count($request['EntryTicketId']);
        }
        else
        {
             $EventEntryTickets_count = 0;
        }
        
            for($i = 0;$i < $EventEntryTickets_count; $i++)
            {
                $PurchasedEventEntryTickets = new PurchasedEventEntryTickets();
                $PurchasedEventEntryTickets->eventId = $request['eventId'];
                $PurchasedEventEntryTickets->userId = auth()->user()->id;
                $PurchasedEventEntryTickets->ticketId = $request['EntryTicketId'][$i];
                $PurchasedEventEntryTickets->ticketQty = $request['ticketQty'][$i];
                $PurchasedEventEntryTickets->ticketAmount = $request['ticketPrice'][$i];
                $PurchasedEventEntryTickets->save();
            }
            if(isset($request['FoodTicketId']))
            {
                 $EventFoodTickets_count = count($request['FoodTicketId']);
            }
            else
            {
                 $EventFoodTickets_count = 0;
            }

            for($i = 0;$i < $EventFoodTickets_count; $i++)
            {
                $PurchasedEventFoodTickets = new PurchasedEventFoodTickets();
                $PurchasedEventFoodTickets->eventId = $request['eventId'];
                $PurchasedEventFoodTickets->userId = auth()->user()->id;
                $PurchasedEventFoodTickets->ticketId = $request['FoodTicketId'][$i];
                $PurchasedEventFoodTickets->ticketQty = $request['FoodticketQty'][$i];
                $PurchasedEventFoodTickets->ticketAmount = $request['FoodticketPrice'][$i];
                $PurchasedEventFoodTickets->save();
            }
            for($i = 0;$i < $competition_idCount; $i++)
            {
                $CompetitionRegistered = new CompetitionRegistered();
                $CompetitionRegistered->event_id =  $request['eventId'];
                $CompetitionRegistered->participant_id = $CompetitionStore['participant_id'][$i];
                $CompetitionRegistered->competition_id = $CompetitionStore['competition_id'][$i];
                $CompetitionRegistered->fees = $CompetitionStore['member_fee'][$i];
                $CompetitionRegistered->save();
            }

            Session::forget('TicketStore');
            Session::forget('CompetitionStore');
            Session::forget('Events');
           return redirect('/memberTickets')->withSuccess('Ticket Purchased Successfully');

    }


    public function MemberPurchasedDetails()
    {
        $email = Auth::user()->tagDvid;
         $member = Member::where('tagDvId',Auth::user()->tagDvid)->first();
         
        $membership = MembershipBuy::where('user_id', Auth::user()->tagDvid)->get();
        
        $PurchasedEventFoodTickets = array();
        $PurchasedEventEntryTickets = array();
        return view('user.purchasedmembership',compact('membership','member','PurchasedEventFoodTickets','PurchasedEventEntryTickets'));
    }
    public function MemberPurchasedTicketDetails()
    {
        $email = Auth::user()->tagDvid;
        $member = Member::where('tagDvId',Auth::user()->tagDvid)->first();
        $membership = DB::table('membership_configs')->where('membership_code','<=',$member->membershipType)->get();

        $PurchasedEventFoodTickets = PurchasedEventFoodTickets::groupBy(DB::raw("eventId"))   ->selectRaw('sum(ticketQty) as sum, eventId,userId,ticketAmount')
                        ->where('userId',Auth::user()->id)
                        ->get();
        $PurchasedEventEntryTickets = PurchasedEventEntryTickets::groupBy(DB::raw("eventId"))   ->selectRaw('sum(ticketQty) as sum, eventId,userId,ticketAmount')
                        ->where('userId',Auth::user()->id)
                        ->get();
        
        return view('user.purchasedmembership',compact('membership','member','PurchasedEventFoodTickets','PurchasedEventEntryTickets'));
    }

    public function membership()
    {  
        $email = Auth::user()->email;
        $member = Member::where('Email_Id',$email)->first();
         $date = Carbon::now()->format('Y');
         $membership = DB::table('membership_configs')->where('is_visible','yes')->where('year',$date)->get();

        return view('user.membership',compact('membership'));
    }
     public function membershipAdd($id)
    {  
        $email = Auth::user()->email;
        $member = Member::where('Email_Id',$email)->first();
         $date = Carbon::now()->format('Y');
         $membership = DB::table('membership_configs')->where('id',$id)->first();

        return view('user.buymembership',compact('membership'));
    }


    public function membershipPost(Request $request)
    {    
        $NonMember = NonMember::where('user_id',Auth::user()->id)->first();
        if($NonMember->firstName==null || $NonMember->lastName==null ||$NonMember->mobile_number==null ||$NonMember->Email_Id==null ||$NonMember->addressLine1==null || $NonMember->addressLine2==null || $NonMember->country==null || $NonMember->state==null || $NonMember->zipCode==null || $NonMember->gender==null || $NonMember->dob==null || $NonMember->maritalStatus==null)
        {
             return redirect('/editProfile')->withWarning('Must Fill ur Profile');
        } 
        else
        {

            $membershipBuy = new MembershipBuy();
            $membershipBuy->user_id = Auth::user()->Member_Id;
            $membershipBuy->membership_id = $request->membership_id;
            $membershipBuy->membership_code = $request->membershipType;;
            $membershipBuy->membership_amount =$request->membershipAmount;
            $membershipBuy->payment_status = "Pending";
            $membershipBuy->save();


            $Member = new Member();
            $Member->Member_Id = Auth::user()->Member_Id;
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
            $Member->membershipType =$request->membershipType;
            $Member->membershipExpiryDate = $request->Validity;
            $Member->save();
            $NonMember = NonMember::where('user_id',Auth::user()->id)->delete();
            
           return redirect('/memberTickets')->withSuccess('Membership Added Successfully');
        }
    }

    public function editProfile()
    {
        $member = Member::where('user_id',Auth::user()->id)->first();
        if($member!=null)
        {

            return view('user.editProfile',compact('member'));
        }
        else
        {
            $member = NonMember::where('user_id',Auth::user()->id)->first();
            return view('user.editProfile',compact('member'));
        }
        
    }

    public function editProfilePost(Request $request)
    {
        $member = Member::where('user_id',Auth::user()->id)->first();
        if($member!=null)
        {
            $member = Member::where('user_id',Auth::user()->id)->update([
            'gender' => $request->gender,
            'addressLine1' => $request->address1,
            'addressLine2' => $request->address2,
            'country' => $request->city,
            'state' => $request->state,
            'zipCode' => $request->zipCode,
            'maritalStatus' => $request->marital,
            'dob' => $request->dob,
            'mobile_number' => $request->mobile,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            ]);
        }
        else
        {     
            $NonMember = NonMember::where('user_id',Auth::user()->id)->update([
            'gender' => $request->gender,
            'addressLine1' => $request->address1,
            'addressLine2' => $request->address2,
            'country' => $request->city,
            'state' => $request->state,
            'zipCode' => $request->zipCode,
            'maritalStatus' => $request->marital,
            'dob' => $request->dob,
            'mobile_number' => $request->mobile,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            ]);
        }

        
       
       return redirect()->back()->withSuccess('Profile Updated Successfully');
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
        
       
        public function edit_members()
        {
            return view('user.edit_members');
        }


}
