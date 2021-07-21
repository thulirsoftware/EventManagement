<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyMember;
use Auth;

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
        return redirect('/familyMembers')->withSuccess('Family Member added Successfully');
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
            $family->dob = $request->dob;
            $family->mob = $request->mob;
            $family->schoolName = $request->schoolName;

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
}
