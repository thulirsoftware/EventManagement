<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\LocationModel;

class CompetitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function ListCompetition()
    {
        $Competition = Competition::orderby('id','desc')->get();
        return view('admin.competition.list',compact('Competition'));
    }

    public function AddCompetition()
    {
        $locations = LocationModel::where('status','Y')->orderby('id','desc')->get();
        return view('admin.competition.add',compact('locations'));
    }

    public function SaveCompetition(Request $request)
    {
        
        $Competition = new Competition;
        $Competition->name = $request->Name;
        $Competition->awards = $request->awards;
        $Competition->min_age = $request->age_limit;
        $Competition->max_age = $request->max_age;
        $Competition->competition_type = $request->competition_type;
        $Competition->starting_date = $request->starting_date;
        $Competition->closing_date = $request->closing_date;
        $Competition->member_fee = $request->member_fee;
        $Competition->non_member_fee = $request->non_member_fee;
        $Competition->instruction = $request->instruction;
        $Competition->save();
            return redirect(route('admin.competition.list'));
    }
    public function EditCompetition($id)
    {

        $competition = Competition::where('id',$id)->first();

        return view('admin.competition.edit',compact('competition'));
    }
    public function UpdateCompetition(Request $request)
    {
        $Competition = Competition::find($request->id);
       $Competition->name = $request->Name;
        $Competition->awards = $request->awards;
        $Competition->min_age = $request->age_limit;
        $Competition->max_age = $request->max_age;
        $Competition->competition_type = $request->competition_type;
        $Competition->starting_date = $request->starting_date;
        $Competition->closing_date = $request->closing_date;
        $Competition->member_fee = $request->member_fee;
        $Competition->non_member_fee = $request->non_member_fee;
        $Competition->instruction = $request->instruction;
        $Competition->save();
            return redirect(route('admin.competition.list'));
    }
    
    public function DeleteCompetition(Request $request)
        {
            $Competition = Competition::find($request->CompetitionId);

            if($Competition->delete()){
            return redirect(route('admin.competition.list'))->withSuccess('Competition Removed Successfully');


            }else{
                return redirect(route('admin.competition.list'))->withSuccess('Competition Removed Successfully');

            }
        }
}
