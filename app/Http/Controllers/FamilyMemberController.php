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

class FamilyMemberController extends Controller
{
    public function familyMembers()
    {
        $tagDvId = Auth::user()->id;
        $familyMembers = FamilyMember::where('user_id',$tagDvId)->orderby('id','desc')->get();

        return view('user.familyMembers',compact('familyMembers'));
    }

    public function ShowFamilyMembers()
    {
        $tagDvId = Auth::user()->Member_Id;
         $membership = MembershipMandatory::get();
        return view('user.addFamilyMembers',compact('tagDvId','membership'));
    }   

    public function addFamilyMembers(Request $request)
    {
        $age = Carbon::parse($request->dob)->diff(Carbon::now())->y;

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

    public function familyEdit($id)
    {

        $family = FamilyMember::find($id);

        $family['day'] =$family['dob'];
        $family['month'] =$family['mob'];

        return view('user.editFamilyMembers',compact('family'));
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
                    $Volunteer->family_member_id = $request->familyMemberId;
                    $Volunteer->user_id = Auth::user()->id;
                    $Volunteer->name = $FamilyMember->firstName;
                    $Volunteer->email = Auth::user()->email;
                    $Volunteer->mobile_number =$FamilyMember->phoneNo;
                    $Volunteer->email_group = $request->email_group;
                    $Volunteer->opportunities =$str;
                    $Volunteer->comments =$request->comments;
                    $Volunteer->youth_volunteer =$request->youth_volunteer;
                    $Volunteer->save();
                }
                
                return redirect()->back()->withSuccess('Volunteer added Successfully');
            }

        }



    
}
