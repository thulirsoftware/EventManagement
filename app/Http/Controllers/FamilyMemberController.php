<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyMember;

class FamilyMemberController extends Controller
{
    public function familyMembers()
    {
    	$familyMembers = FamilyMember::all();

        return view('user.familyMembers',compact('familyMembers'));
    }

    public function addFamilyMembers(Request $request)
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

        $family = new FamilyMember;
        $family->tagDvId = $request->tagDvId;
        $family->firstName = $request->firstName;
        $family->lastName = $request->lastName;
        $family->relationshipType = $request->relationshipType;
        $family->phoneNo = $request->phoneNo;
        $family->dob = $request->dob;
        $family->schoolName = $request->schoolName;
        $family->save();

        return redirect()->back();
    }

    public function familyEdit($id)
    {

        $family = FamilyMember::find($id);

        $family['day'] =substr($family['dob'], 0, 2);
        $family['month'] =substr($family['dob'], -2);

        return view('user.editFamilyMembers',compact('family'));
    }

    public function familyUpdate(Request $request)
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
        $request->dob = $request->dobDate."/".$request->dobMonth;
        
        $family = FamilyMember::find($request->id);

            $family->tagDvId = $request->tagDvId;
            $family->firstName = $request->firstName;
            $family->lastName = $request->lastName;
            $family->relationshipType = $request->relationshipType;
            $family->phoneNo = $request->phoneNo;
            $family->dob = $request->dob;
            $family->schoolName = $request->schoolName;

            if($family->save()){

               return redirect('/familyMembers');
            
            }else{

                return redirect('/familyMembers');
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