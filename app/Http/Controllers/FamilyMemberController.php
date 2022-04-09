<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyMember;
use Auth;
use App\MembershipConfig;
use Session;
use Carbon\Carbon; 
use App\Volunteer;
use App\MembershipMandatory;
use App\MembershipBuy;
use App\Member;
use App\NonMember;

class FamilyMemberController extends Controller
{
    public function familyMembers()
    {
        $tagDvId = Auth::user()->id;
        $familyMembers = FamilyMember::where('user_id',$tagDvId)->where('is_family_member','Y')->orderby('id','desc')->get();

        return view('user.familyMembers',compact('familyMembers'));
    }

    public function ShowFamilyMembers()
    {$tagDvId = Auth::user()->Member_Id;
        $membership = MembershipConfig::get();
        $membershipMandatory = MembershipMandatory::get();
        
         $selfCount = FamilyMember::where('is_family_member','N')->where('user_id',Auth::user()->id)->count();
        if($selfCount<=0)
        {
            $member = Member::where('user_id',Auth::user()->id)->first();
            if($member)
            {
                $age = Carbon::parse($member->dob)->diff(Carbon::now())->y;
                $new = new FamilyMember();
                $new->firstName = $member->firstName;
                $new->lastName =  $member->lastName;
                $new->user_id = Auth::user()->id;
                $new->Member_Id =$member->Member_Id;
                $new->age = $age;
                $new->dob = $member->dob;
                $new->phoneNo = $member->mobile_number;
                $new->is_family_member ='N';
                $new->relationshipType ='Self';
                $new->save();
            }

            else
            {
                 $member = Member::where('user_id',Auth::user()->id)->first();
                 $age = Carbon::parse($member->dob)->diff(Carbon::now())->y;
                $new = new FamilyMember();
                $new->firstName = $member->firstName;
                $new->lastName =  $member->lastName;
                $new->user_id = Auth::user()->id;
                $new->dob = $member->dob;
                $new->age = $age;
                $new->phoneNo = $member->mobile_number;
                $new->is_family_member ='N';
                $new->relationshipType ='Self';
                $new->save();
            }
            
        }
         else
        {
            $new = FamilyMember::where('is_family_member','N')->where('user_id',Auth::user()->id)->first();
            
             $member = Member::where('user_id',Auth::user()->id)->first();
            if($member)
            {
                $age = Carbon::parse($member->dob)->diff(Carbon::now())->y;
                $new->age = $age;
                $new->dob = $member->dob;
                $new->relationshipType ='Self';
                $new->save();
            }

            else
            {
                $member = NonMember::where('user_id',Auth::user()->id)->first();
                 $age = Carbon::parse($member->dob)->diff(Carbon::now())->y;
                $new->dob = $member->dob;
                $new->relationshipType ='Self';
                $new->age = $age;
                $new->save();
            }
        }
        return view('user.addFamilyMembers',compact('tagDvId','membership','membershipMandatory'));
    }   

    public function addFamilyMembers(Request $request)
    {
        $age = Carbon::parse($request->dob)->diff(Carbon::now())->y;
         $familyMember = FamilyMember::where('user_id',Auth::user()->id)->where('relationshipType',$request->relationshipType)->count();
            if($request->relationshipType=='Daughter')
            {
                    $family = new FamilyMember;
                     $family->user_id = Auth::user()->id;
                    $family->Member_Id = $request->tagDvId;
                    $family->firstName = $request->firstName;
                    $family->lastName = $request->lastName;
                    $family->relationshipType = $request->relationshipType;
                    $family->phoneNo = $request->phoneNo;
                    $family->dob = $request->dob;
                    $family->age = $age;
                    $family->save();
                    return redirect()->back()->withSuccess('Family Member added Successfully');
                
            
            }
            else if($request->relationshipType=='Son')
            {
                    $family = new FamilyMember;
                     $family->user_id = Auth::user()->id;
                    $family->Member_Id = $request->tagDvId;
                    $family->firstName = $request->firstName;
                    $family->lastName = $request->lastName;
                    $family->relationshipType = $request->relationshipType;
                    $family->phoneNo = $request->phoneNo;
                    $family->dob = $request->dob;
                    $family->age = $age;
                    $family->save();
                    return redirect()->back()->withSuccess('Family Member added Successfully');
                
            
            }
            else if($familyMember>0)
            {
                return redirect()->back()->withWarning('Your already added this relationship');
            }
            else
            {
                    $family = new FamilyMember;
                     $family->user_id = Auth::user()->id;
                    $family->Member_Id = $request->tagDvId;
                    $family->firstName = $request->firstName;
                    $family->lastName = $request->lastName;
                    $family->relationshipType = $request->relationshipType;
                    $family->phoneNo = $request->phoneNo;
                    $family->dob = $request->dob;
                    $family->age = $age;
                    $family->save();
                    return redirect()->back()->withSuccess('Family Member added Successfully');
            }
    }

    public function familyEdit($id)
    {

        $family = FamilyMember::find($id);

        $family['day'] =$family['dob'];
        $family['month'] =$family['mob'];
         $purchased = MembershipBuy::where('user_id',Auth()->user()->id)->first();
         $conf = MembershipConfig::where('membership_code',$purchased->membership_code)->first();

        $membership = MembershipMandatory::where('membership_id',$conf->membership_type)->get();

        return view('user.editFamilyMembers',compact('family','membership'));
    }

    public function familyUpdate(Request $request)
    {
        $age = Carbon::parse($request->dob)->diff(Carbon::now())->y;
        $family = FamilyMember::find($request->id);

            $family->firstName = $request->firstName;
            $family->lastName = $request->lastName;
            $family->relationshipType = $request->relationshipType;
            $family->phoneNo = $request->phoneNo;
            $family->dob = $request->dob;
            $family->age = $age;
            if($family->save()){

                return redirect('/familyMembers')->withSuccess('Family Member updated Successfully');
            }else{

        return redirect()->back()->withSuccess('Family Member updation Failed');
            }
    }

    public function familyDelete($id)
    {
        $family = FamilyMember::find($id);

        if($family->delete()){

            return redirect()->back();

        }else{
            
            return redirect()->back();
        }
    }

    public function SkipFamilyMembers()
    {
        $membership = Session::get('membership');
        $membership = MembershipConfig::where('id',$membership['id'])->first();
        return view('user.buymembership',compact('membership'));
    }

    public function AddMembershipFamilyMembers(Request $request)
    {
            if($request->has('firstName'))
            {
                $firstNameCount = count($request->firstName); 
            }
            else
            {
                 $firstNameCount = 0;
            }

            for($i = 0;$i < $firstNameCount; $i++)
            {   
                 $age = Carbon::parse($request->dob[$i])->diff(Carbon::now())->y; 
                $family = new FamilyMember;
                $family->user_id = Auth::user()->id;
                $family->Member_Id = Auth::user()->Member_Id;
                $family->firstName = $request->firstName[$i];
                $family->lastName = $request->lastName[$i];
                $family->relationshipType = $request->relationshipType[$i];
                $family->phoneNo = $request->phoneNo[$i];
                $family->dob = $request->dob[$i];
                $family->age = $age;
                if($request->relationshipType[$i]!=null)
                {
                    $family->save();
                }
            }
        return redirect('/MemberShip/Buy');
    }
    public function MembershipBuy()
    {
         $membership = Session::get('membership');
        $membership = MembershipConfig::where('id',$membership['id'])->first();
        return view('user.buymembership',compact('membership'));
    }
    public function AddAsVolunteer($id)
    {
        return view('user.familyMember.make_volunteer',compact('id'));
    }

     public function AddVolunteerSave(Request $request)
    {            

            $Volunteer = Volunteer::where('family_member_id',$request->familyMemberId)->count();
           if($Volunteer>0)
            {
                return redirect()->back()->withWarning('Your Already an volunteer');
            }
            else
            {
                $str = implode (", ", $request->opportunities);
                $FamilyMember = FamilyMember::where('id',$request->familyMemberId)->first();
                if($FamilyMember!=null)
                {
                    $Volunteer = new Volunteer();

                     $Volunteer->volunteer_from = $request->volunteer_from;
                    $Volunteer->family_member_id = $request->familyMemberId;

                    $Volunteer->user_id = Auth::user()->id;
                    $Volunteer->name = $FamilyMember->firstName;
                    $Volunteer->email = Auth::user()->email;
                    $Volunteer->mobile_number =$FamilyMember->phoneNo;
                    $Volunteer->email_group = $request->email_group;
                    $Volunteer->opportunities =$str;
                    $Volunteer->comments =$request->comments;
                    $Volunteer->youth_volunteer =$request->youth_volunteer;
                    $Volunteer->volunteer_for =$request->volunteer_for;
                    $Volunteer->save();
                }
                
                return redirect()->back()->withSuccess('Volunteer added Successfully');
            }

        }



    
}
