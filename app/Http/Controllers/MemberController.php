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
use App\EventRegistration;
use App\Volunteer;
use Hash;
use App\MembershipConfig;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Donation;
use App\SponsorshipCfg;
use App\Sponsorship;
use App\MembershipMandatory;

class MemberController extends Controller
{
 
    public function memberTickets()
    {
        
        $toDay =Carbon::now()->toDateString();
        $EventCompetition = EventRegistration::where('user_id',Auth::user()->id)->pluck('event_id');
        //$EventRegistration->user_id = Auth::user()->id;

        $events = Event::whereNotIn('id',$EventCompetition)->where('eventDate','>=',$toDay)->orderby('id','desc')->get();
       
        return view('user.memberTickets',compact('events'));
    }

    public function memberBuyTicket($id)
    {
        $this_year = Carbon::now()->format('Y');
        $events = Event::where('id', $id)->first();
        $Member = Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','<=',$this_year)->first();
        $this_year = Carbon::now()->format('Y-m-d');
        $events = Event::where('id', $id)->first();
        $Member = Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
        if($Member!=null)
         {
            $memberTickets = EventTicket::where('eventId', $id)->where('memberType','member')->get();
            $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'member')->get();
         }
         else
         {
            $memberTickets = EventTicket::where('eventId', $id)->where('memberType','NonMember')->get();
         $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'NonMember')->get();
         }
        
        $member = Auth::user()->email;
        $user = Member::where('Email_Id',$member)->get();
        $competitionCount = EventCompetition::where('event_id',$id)->where('competition_id','!=',NULL)->count();
        $todayDate =Carbon::now()->toDateString();
        return view('user.memberBuyTicket',compact('memberTickets','user','todayDate','memberEventTickets','events','id','competitionCount'));
    }

    public function EditmemberBuyTicket($id)
    {
        $this_year = Carbon::now()->format('Y');
        $events = Event::where('id', $id)->first();
        $Member = Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','<=',$this_year)->first();
        $this_year = Carbon::now()->format('Y-m-d');
        $events = Event::where('id', $id)->first();
        $Member = Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
        if($Member!=null)
         {
            $memberTickets = EventTicket::where('eventId', $id)->where('memberType','member')->get();
            $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'member')->get();
         }
         else
         {
            $memberTickets = EventTicket::where('eventId', $id)->where('memberType','NonMember')->get();
         $memberEventTickets = EventEntryTickets::where('eventId',$id)->where('memberType',"=", 'NonMember')->get();
         }
        
        $member = Auth::user()->email;
        $user = Member::where('Email_Id',$member)->get();
        $competitionCount = EventCompetition::where('event_id',$id)->where('competition_id','!=',NULL)->count();
        $todayDate =Carbon::now()->toDateString();
        return view('user.EditmemberBuyTicket',compact('memberTickets','user','todayDate','memberEventTickets','events','id','competitionCount'));
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
        $compeitionAmounts = "0";
        $events = Event::where('id', $request->eventId)->first();
        Session::put('Events', $events);
        return view('user.view_purchased_amount_details',compact('totalAmount','ticketCount','foodticketCount','EntryTicketAmounts','FoodAmount','compeitionAmounts'));
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
    public function memberTicketAmountPay(Request $req)
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
        $TicketPurchase->payment_type = $req['payment_type'];
        $TicketPurchase->user_id = Auth::user()->id;
        $TicketPurchase->save();

        $EventRegistration = new EventRegistration();
        $EventRegistration->user_id = Auth::user()->id;
        $EventRegistration->event_id = $request['eventId'];
        $EventRegistration->save();

        
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
                 $CompetitionRegistered->user_id = Auth::user()->id;
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
        $membership = MembershipConfig::where('membership_code','<=',$member->membershipType)->get();

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
        $email = Auth::user()->id;
        $member = Member::where('user_id',$email)->first();
        $date = Carbon::now()->format('Y-m-d');
        if($member==null)
        {
            $member = NonMember::where('user_id',$email)->first();
            $MembershipBuy = MembershipBuy::where('user_id',$email)->pluck('membership_id');
            $membershipcount = MembershipConfig::orderby('id','desc')->whereIn('id',$MembershipBuy)->where('is_visible','yes')->where('closing_date','>=',$date)->count();
            if($membershipcount<=0)
            {
               $membership = MembershipConfig::orderby('id','desc')->where('is_visible','yes')->where('closing_date','>=',$date)->get(); 
            }
            else
            {
              $membership = MembershipConfig::orderby('id','desc')->whereIn('id',$MembershipBuy)->where('is_visible','yes')->where('closing_date','>=',$date)->get();  
            }
        }
        else
        {
            $MembershipBuy = MembershipBuy::where('user_id',$email)->pluck('membership_id');
            $membershipcount = MembershipConfig::orderby('id','desc')->whereIn('id',$MembershipBuy)->where('is_visible','yes')->where('closing_date','>=',$date)->count();
            if($membershipcount<=0)
            {
               $membership = MembershipConfig::orderby('id','desc')->where('is_visible','yes')->where('closing_date','>=',$date)->get(); 
            }
            else
            {
              $membership = MembershipConfig::orderby('id','desc')->whereIn('id',$MembershipBuy)->where('is_visible','yes')->where('closing_date','>=',$date)->get();  
            }
        }

        return view('user.membership',compact('membership'));
        
    }

    public function membershipAdd($id)
    {  
        
        $email = Auth::user()->email;
        $member = Member::where('Email_Id',$email)->first();
        $date = Carbon::now()->format('Y');
        $membership = MembershipConfig::where('id',$id)->first();
        $Member = Member::where('user_id',Auth::user()->id)->first();
        Session::put('membership',$membership);
        if($Member==null)
        {
            $NonMember = NonMember::where('user_id',Auth::user()->id)->first();
            $member = NonMember::where('user_id',Auth::user()->id)->first();
               if($NonMember->firstName==null || $NonMember->lastName==null ||$NonMember->mobile_number==null ||$NonMember->Email_Id==null ||$NonMember->addressLine1==null || $NonMember->country==null || $NonMember->state==null || $NonMember->zipCode==null || $NonMember->gender==null  || $NonMember->maritalStatus==null)

                {
                    
                    return view('user.membership.update_profile',compact('member'));
                }
               elseif($membership->membership_type=="Family"|| $membership->membership_type=="Special Membership" || $membership->membership_type=="Senior Membership")
                {
                    $mandatory = MembershipMandatory::where('membership_id',$membership->membership_type)->where('status','O')->get();
                    $mandatoryAjax = MembershipMandatory::where('membership_id',$membership->membership_type)->where('status','O')->get();
                    return view('user.membership.addFamilyMember',compact('mandatory','mandatoryAjax'));
                } 

                else
                {
                    return view('user.buymembership',compact('membership'));
                }
        }

        else
        {
            $Member = Member::where('user_id',Auth::user()->id)->first();
            if($Member->firstName==null || $Member->lastName==null ||$Member->mobile_number==null ||$Member->Email_Id==null ||$Member->addressLine1==null || $Member->addressLine2==null || $Member->country==null || $Member->state==null || $Member->zipCode==null || $Member->gender==null || $Member->dob==null || $Member->maritalStatus==null)
            {
                return view('user.membership.update_profile',compact('member'));
            } 
            elseif($membership->membership_type=="Family"|| $membership->membership_type=="Special Membership" || $membership->membership_type=="Senior Membership")
            {
                $mandatory = MembershipMandatory::where('membership_id',$membership->membership_type)->where('status','O')->get();
                 $mandatoryAjax = MembershipMandatory::where('membership_id',$membership->membership_type)->where('status','O')->get();
                 return view('user.membership.addFamilyMember',compact('mandatory','mandatoryAjax'));
            } 

            else
            {
                return view('user.buymembership',compact('membership'));
            }
           
        }
       // return view('user.buymembership',compact('membership'));
    }
    public function membershipPost(Request $request)
    {

            $membershipBuy = new MembershipBuy();
            $membershipBuy->user_id = Auth::user()->id;
            $membershipBuy->membership_id = $request->membership_id;
            $membershipBuy->membership_code = $request->membership_code;;
            $membershipBuy->membership_amount =$request->membershipAmount;
             $membershipBuy->Inst_type =$request->payment_method;
            $membershipBuy->payment_status = "Completed";
            $membershipBuy->save();
            
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
        $userId=$user[0]['id'];

        $Member_Id='NETS'.sprintf("%07d", ++$userId);
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
            $Member->membershipAmount = $request->membershipAmount;
            $Member->membershipType =$request->membership_code;
            $Member->membershipExpiryDate = "2021-12-31";
            
            if($Member->save()){
                $User = User::find(Auth::user()->id);
                $User->Member_Id = $Member_Id;
                $User->save();
                
                $FamilyMember = FamilyMember::where('user_id',Auth::user()->id)->first();
                if($FamilyMember)
                {
                    $FamilyMember->Member_Id = $Member_Id;
                    $FamilyMember->save();
                }
                
                $NonMember = NonMember::where('user_id',Auth::user()->id)->delete();
            }
        }
        else
        {
            $Member = Member::where('Email_Id',$NonMember->Email_Id)->first();
            $Member->membershipExpiryDate =$request->closing_date;
            $Member->save();

        }
           return redirect('/memberTickets')->withSuccess('Membership Added Successfully');
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
       // dd(URL::previous());
        $paths = URL::previous();
        $age = Carbon::parse($request->dob)->diff(Carbon::now())->y;
        $member = Member::where('user_id',Auth::user()->id)->first();
        if($member!=null)
        {
            if ($request->hasFile('profile')){  
                 
             $file = $request->file('profile');
             
             $extension = $file->getClientOriginalExtension(); 
             
             $fileName = time().'.'.$extension;
             
             $path = public_path().'/profiles';
             
             $uplaod = $file->move($path,$fileName);
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
                'profile'=>$fileName
                ]);
             
             }
             else{
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
            
        }
        else
        {  
            if ($request->hasFile('profile')){  
                 
             $file = $request->file('profile');
             
             $extension = $file->getClientOriginalExtension(); 
             
             $fileName = time().'.'.$extension;
             
             $path = public_path().'/profiles';
             
             $uplaod = $file->move($path,$fileName); 
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
            'profile'=>$fileName
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
        }

        if(Str::contains($paths,['editProfile']))
        {
            return redirect()->back()->withSuccess('Profile Updated Successfully'); 
        }
        else
        {
            if($age>18)
            {
                 return redirect()->back()->withSuccess('Profile Updated Successfully');
            }
            else
            {
                  return redirect()->back()->withWarning('You are age is less than 18');
            }
        }
        
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

        public function MyEvents()
        {
            $toDay =Carbon::now()->toDateString();
            $EventRegistration = EventRegistration::where('user_id',Auth::user()->id)->pluck('event_id');

            $events = Event::whereIn('id',$EventRegistration)->get();
            return view('user.MyEvents',compact('events'));
        }

        public function ViewEvent($id)
        {
            $events = Event::where('id',$id)->first();
            
            $Purchased_Entry_Tickets = PurchasedEventEntryTickets::where('eventId',$id)->where('userId',Auth::user()->id)->where('ticketQty','!=',null)->get();
            $Purchased_Food_Tickets = PurchasedEventFoodTickets::where('eventId',$id)->where('userId',Auth::user()->id)->where('ticketQty','!=',null)->get();
            $CompetitionRegistered = CompetitionRegistered::where('event_id',$id)->where('user_id',Auth::user()->id)->get();
            return view('user.ViewEvents',compact('events','CompetitionRegistered','id','Purchased_Entry_Tickets','Purchased_Food_Tickets'));
        }

        public function AddVolunteer()
        {
            return view('user.addVolunteer');
        }

        public function AddVolunteerSave(Request $request)
        {
            if($request->opportunities[0]==null)
            {
                return redirect()->back()->withWarning('Must Enable one opportunities');
            }
            $Volunteer = Volunteer::where('user_id',Auth::user()->id)->count();
            if($Volunteer>0)
            {
                return redirect()->back()->withWarning('Your Already an volunteer');
            }
            else
            {
                $str = implode (", ", $request->opportunities);
                $member = Member::where('user_id',Auth::user()->id)->first();
                if($member!=null)
                {
                    $Volunteer = new Volunteer();
                    $Volunteer->user_id = Auth::user()->id;
                    $Volunteer->name = Auth::user()->name;
                    $Volunteer->email = Auth::user()->email;
                    $Volunteer->mobile_number =$member->mobile_number;
                    $Volunteer->email_group = $request->email_group;;
                    $Volunteer->opportunities =$str;
                    $Volunteer->comments =$request->comments;
                    $Volunteer->youth_volunteer =$request->youth_volunteer;
                    $Volunteer->save();
                }
                else
                {
                    $NonMember = NonMember::where('user_id',Auth::user()->id)->first();
                    $Volunteer = new Volunteer();
                    $Volunteer->user_id = Auth::user()->id;
                    $Volunteer->name = Auth::user()->name;
                    $Volunteer->email = Auth::user()->email;
                    $Volunteer->mobile_number =$NonMember->mobile_number;
                    $Volunteer->email_group = $request->email_group;;
                    $Volunteer->opportunities =$str;
                    $Volunteer->comments =$request->comments;
                    $Volunteer->youth_volunteer =$request->youth_volunteer;
                    $Volunteer->save();
                   
                }
                return redirect()->back()->withSuccess('Volunteer added Successfully');
            }

        }

        public function ChangePassword()
        {
           return view('user.changepassword');
        }

        public function UpdatePassword(Request $request)
        {
            $this->validate($request, [
                'old_password' => 'required',
                'password'     => 'required|confirmed',
            ]);
            $data = $request->all();
         
            $user = User::find(auth()->user()->id);
            if(!Hash::check($data['old_password'], $user->password))
                {
                 return back()->withWarning('Your Old Password is does not match');
                }
                else
                {
                    $user = User::find(auth()->user()->id);
                    $user->password = bcrypt($request['password']);
                    $user->save();
                    return back()->withSuccess('Password Updated Successfully');
                }
        }

        public function AgeValidation(Request $request)
        {
            $Competition = Competition::where('id',$request->id)->first();

            $CompetitionRegistered = CompetitionRegistered::where('competition_id',$request->id)->where('user_id',Auth::user()->id)->pluck('participant_id');

            $familyMembers = FamilyMember::whereNotIn('id',$CompetitionRegistered)->where('user_id',Auth::user()->id)->orderby('id','desc')->get();
            $familyMembersCount = FamilyMember::whereNotIn('id',$CompetitionRegistered)->where('user_id',Auth::user()->id)->orderby('id','desc')->count();
            if($familyMembersCount>0)
            {
                return response($familyMembers, 200);
            }
            else
            {
                return response($familyMembers, 400);
            }
                
        }

        /******** Donation *********/

        public function Donation()
        {
            return view('user.donation.add');
        }

        public function AddDonation(Request $request)
        {
            $donation = new Donation();
            $donation->user_id = Auth::user()->id;
            $donation->name = $request->name;
            $donation->email = $request->email;
            $donation->mobile_no =$request->phone;
            $donation->amount =$request->amount;
            $donation->address =$request->address;
            $donation->city =$request->city;
            $donation->pincode =$request->pincode;
            $donation->comments =$request->comments;
            $donation->save();
            return back()->withSuccess('Donation added Successfully');
        }

        /******** Sponsorship *********/
        
        public function Sponsorship()
        {
            $configs = SponsorshipCfg::get();
            $configsAjax = SponsorshipCfg::get();
            $toDay = Carbon::now()->toDateString();
            
            return view('user.sponsor.add',compact('configs','configsAjax'));
        }

        public function AddSponsorship(Request $request)
        {
            $sponsorship = new Sponsorship();
            $sponsorship->user_id = Auth::user()->id;
            $sponsorship->sponsorship_id = $request->sponsorship_id;
            $sponsorship->event_id = $request->event_id;
            $sponsorship->amount = $request->amount;
            
            $sponsorship->payment_status = "Pending";
            $sponsorship->save();
            return back()->withSuccess('Sponsor package  added Successfully');
        }


}
