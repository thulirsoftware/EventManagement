<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SponsorshipCfg;
use Carbon\Carbon;
use App\Event;
use App\Sponsorship;

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
            $toDay = Carbon::now()->toDateString();
            $Events = Event::where('eventDate','>=',$toDay)->get();
            return view('admin.sponsorship.add',compact('Events'));
        }

        public function Save(Request $request)
        {
            $fileName = "";
                 if ($request->hasFile('image')){  
                     
                 $file = $request->file('image');
                 
                 $extension = $file->getClientOriginalExtension(); 
                 
                 $fileName = time().'.'.$extension;
                 
                 $path = public_path().'/benefits';
                 
                 $uplaod = $file->move($path,$fileName); 
             }
            $sponsorship = new SponsorshipCfg;
            $sponsorship->amount = $request->amount;
            $sponsorship->benefits =$request->benefits;
            $sponsorship->files =$fileName;
            $sponsorship->name = $request->name;
            $sponsorship->type = $request->type;
            $sponsorship->event_id = $request->event_id;
            $sponsorship->save();
           return redirect()->back()->withSuccess('Sponsorship Type Added Successfully');

        }

        public function Edit($id)
        {
            $toDay = Carbon::now()->toDateString();
            $Events = Event::where('eventDate','>=',$toDay)->get();
            $sponsorship = SponsorshipCfg::where('id',$id)->first();
            return view('admin.sponsorship.edit',compact('sponsorship','Events'));
        }

        public function Update(Request $request)
        {
           $fileName = "";
           if ($request->hasFile('image')){  
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $fileName = time().'.'.$extension;
                $path = public_path().'/benefits';
                $uplaod = $file->move($path,$fileName); 
             }
            $sponsorship = SponsorshipCfg::find($request->sponsorshipId);
            $sponsorship->amount = $request->amount;
            $sponsorship->benefits =$request->benefits;
             $sponsorship->files =$fileName;
            $sponsorship->name = $request->name;
            $sponsorship->type = $request->type;
            $sponsorship->event_id = $request->event_id;
            $sponsorship->save();
            
            $sponsorship = Sponsorship::where('sponsorship_id',$request->sponsorshipId)->update(['amount'=>$sponsorship->amount,'sponsorship_id'=>$sponsorship->id]);

           return redirect(route('admin.sponsorship.list'))->withSuccess('Sponsorship updated Successfully');
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
