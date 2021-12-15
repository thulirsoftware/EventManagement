<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SponsorshipCfg;

class SponsorshipController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth:admin');
        }

        public function List()
        {
            $sponsorship = SponsorshipCfg::orderby('id','desc')->get();
            return view('admin.sponsorship.list', compact('sponsorship'));
        }

        public function Add()
        {
            return view('admin.sponsorship.add');
        }

        public function Save(Request $request)
        {
            $sponsorship = new SponsorshipCfg;
            $sponsorship->amount = $request->amount;
            $sponsorship->benefits = $request->benefits;
            $sponsorship->name = $request->name;
            $sponsorship->type = $request->type;
            $sponsorship->save();
           return redirect()->back()->withSuccess('Sponsorship Type Added Successfully');

        }

        public function Edit($id)
        {
            $sponsorship = SponsorshipCfg::where('id',$id)->first();
            return view('admin.sponsorship.edit',compact('sponsorship'));
        }

        public function Update(Request $request)
        {
            $sponsorship = SponsorshipCfg::find($request->sponsorshipId);
            $sponsorship->amount = $request->amount;
            $sponsorship->benefits = $request->benefits;
            $sponsorship->name = $request->name;
            $sponsorship->type = $request->type;
            $sponsorship->save();
               
            return redirect(route('admin.sponsorship.list'));
        }


        public function Delete(Request $request)
        {
            $sponsorship = SponsorshipCfg::find($request->sponsorshipId);

            if($sponsorship->delete()){
            return redirect(route('admin.sponsorship.list'))->withSuccess('Sponsorship Removed Successfully');


            }else{
                return redirect(route('admin.sponsorship.list'))->withSuccess('Sponsorship Removed Successfully');

            }
        }
}