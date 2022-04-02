<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MembershipMandatory;
use Session;
use App\NonMember;
use App\FamilyMember;
use App\Member;
use Auth;
use App\MembershipConfig;
use Carbon\Carbon;
use App\MembershipBuy;
use App\User;

class MembershipPurchaseController extends Controller
{
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
            $membershipBuy->save();
            Session::put('membership_paymentId',$membershipBuy->id);
           return redirect('/membershippaymentComplete');
    }

    public function MembershipBuy()
    {
         $membership = Session::get('membership');
        $membership = MembershipConfig::where('id',$membership['id'])->first();
        return view('user.buymembership',compact('membership'));
    }

    public function renew_membership()
    {
            return view('user.renew_membership');
    }
}
