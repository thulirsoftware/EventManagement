<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyMember;
use Auth;
use App\MembershipConfig;
use Session;
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
        return view('user.addFamilyMembers',compact('tagDvId'));
    }   

    public function addFamilyMembers(Request $request)
    {
        $family = new FamilyMember;
         $family->user_id = Auth::user()->id;
        $family->Member_Id = $request->tagDvId;
        $family->firstName = $request->firstName;
        $family->lastName = $request->lastName;
        $family->relationshipType = $request->relationshipType;
        $family->phoneNo = $request->phoneNo;
        $family->dob = $request->dob;
        $family->mob = $request->mob;
        $family->schoolName = $request->schoolName;
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
        $family = FamilyMember::find($request->id);

            $family->firstName = $request->firstName;
            $family->lastName = $request->lastName;
            $family->relationshipType = $request->relationshipType;
            $family->phoneNo = $request->phoneNo;

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
                $family = new FamilyMember;
                $family->user_id = Auth::user()->id;
                $family->firstName = $request->firstName[$i];
                $family->lastName = $request->lastName[$i];
                $family->relationshipType = $request->relationshipType[$i];
                $family->phoneNo = $request->phoneNo[$i];
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
}
