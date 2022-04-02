<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campaign;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function list()
        {
            $campaigns = Campaign::orderby('id','desc')->get();
            return view('admin.campaign.list', compact('campaigns'));
        }

        public function add()
        {
            return view('admin.campaign.add');
        }

        public function create(Request $request)
        {
            $campaign = new Campaign;
            $campaign->name = $request->name;
            $campaign->description = $request->description;
            $campaign->start_date = $request->start_date;
            $campaign->end_date = $request->end_date;
            $campaign->goal = $request->goal;
            $campaign->save();
            return redirect(route('admin.campaign.list'));
        }

        public function edit($id)
        {
            $campaign = Campaign::where('id',$id)->first();
            return view('admin.campaign.edit',compact('campaign'));
        }

        public function update(Request $request)
        {
            $Campaign = Campaign::where('id',$request->campaignId)->update([
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'goal' => $request->goal,
            ]);

            return redirect(route('admin.campaign.list'));
        }


        public function delete(Request $request)
        {
            $campaign = Campaign::find($request->campaignId);

            if($campaign->delete()){
            return redirect(route('admin.campaign.list'))->withSuccess('Campaign Removed Successfully');


            }else{
                return redirect(route('admin.campaign.list'))->withSuccess('Campaign Removed Successfully');

            }
        }
}
