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
use Session;
use DB;
use App\User;
use Carbon\Carbon;


class MemberController extends Controller
{
 
    public function memberTickets()
    {
        
        $baseurl = "/events/";
        $toDay =Carbon::now()->toDateString();
        $events = Event::where('eventDate','>=',$toDay)->get()->toArray();

        foreach($events as $key=>$value){
            $eventId = $value['id'];

            $events[$key]['nonMemberTicketsCount'] = count(EventTicket::where('eventId',"=", $eventId)->where('memberType',"=", 'nonmember')->where('dateRange','>=',$toDay)->get());
            $events[$key]['memberTicketsCount'] = count(EventTicket::where('eventId',"=", $eventId)->where('memberType',"=", 'member')->where('dateRange','>=',$toDay)->get());
        }

        return view('user.memberTickets',compact('baseurl','events'));
    }

    public function memberBuyTicket($id)
    {
        $memberTickets = EventTicket::where('eventId',"=", $id)->where('memberType',"=", 'member')->get();

        $member = Auth::user()->email;
        $user = Member::where('primaryEmail',$member)->get();
        $todayDate =Carbon::now()->toDateString();
        return view('user.memberBuyTicket',compact('memberTickets','user','todayDate'));
    }

    public function memberBuyTicketPost(Request $request)
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

        $request['totalAmount'] = $totalAmount;

        // Session Put
        $sessionData = $request->all();
        Session::put('EventTicket',$sessionData);

        return view('user.memberTicketView',compact('ticketQty','ticketType','ticketPrice','sessionData'));
    }


    public function membership()
    {  
        $email = Auth::user()->email;
        $member = Member::where('primaryEmail',$email)->first();
        $membershipExist = $member->membershipExpiryDate;

        if($membershipExist == null || $membershipExist == ""){
            $membership = DB::table('membership_configs')->where('membership_code','!=',"AMR")->where('is_visible','yes')->get()->toArray();
        }else{
            $membership = DB::table('membership_configs')->where('membership_code','!=',"AM")->where('is_visible','yes')->get()->toArray();
        }
        

        return view('user.membership',compact('membership'));
    }


    public function membershipPost(Request $request)
    {

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $email = $request->email;
        $phoneNo = $request->phoneNo;
        $membershipType = $request->membershipType;

    $membershipDetails = DB::table('membership_configs')->where('membership_code',$request->membershipType)->get()->toArray();
        //dd($totalAmount);
        $request['membership_code'] = $membershipDetails[0]->membership_code;
        $request['membership_desc'] = $membershipDetails[0]->membership_desc;
        $request['membership_amount'] = $membershipDetails[0]->membership_amount;
        $request['tagDvId'] = Auth::user()->tagDvid;

        // Session Put
        $membershipData = $request->all();
        Session::put('Membership',$membershipData);

        return view('user.membershipView',compact('membershipData'));
    }

    public function editProfile()
    {
        $user = Auth::user()->email;
        $member = Member::where('primaryEmail',$user)->first();
        $member['day'] =substr($member['dob'], 0, 2);
        $member['month'] =substr($member['dob'], -2);
        return view('user.editProfile',compact('member'));
    }

    public function editProfilePost(Request $request)
    {
        $dateLength = strlen($request->dobDate);
        $monthLength = strlen($request->dobMonth);
        if($dateLength == 1){
            $request->dobDate = "0".$request->dobDate;
        }
        if($monthLength == 1){
            $request->dobMonth = "0".$request->dobMonth;
        }

        $request->dob = $request->dobDate."/".$request->dobMonth;

        $member = Member::where('primaryEmail',$request->email)->update([
            // 'firstName' => $request->firstName,
            'phoneNo1' => $request->mobile,
            'gender' => $request->gender,
            'addressLine1' => $request->address1,
            'addressLine2' => $request->address2,
            // 'country' => $request->country,
            'state' => $request->state,
            'zipCode' => $request->zipCode,
            // 'lastName' => $request->lastName,
            'maritalStatus' => $request->marital,
            'dob' => $request->dob,
        ]);

        // $member = User::where('email',$request->email)->update([
        //     'name' => $request->firstName,
        // ]);
       
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
        
       
        public function edit_members()
        {
            return view('user.edit_members');
        }
}
