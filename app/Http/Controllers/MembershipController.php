<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MembershipConfig;
use Carbon\Carbon;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ListMembership()
        {
            $date = Carbon::now()->format('Y');
            $memberships = MembershipConfig::where('year',$date)->get();
            return view('admin.Membership.list', compact('memberships'));
        }

        public function AddMembership()
        {
            return view('admin.Membership.add');
        }

        public function SaveMembership(Request $request)
        {
            $membership = new MembershipConfig;
            $membership->membership_code = $request->membershipCode;
            $membership->membership_desc = $request->description;
            $membership->membership_amount = $request->amount;
            $membership->is_visible = $request->isVisible;
            $membership->year = $request->year;
            $membership->save();
            return redirect(route('admin.membership.list'));
        }

        public function EditMembership($id)
        {
            $membership = MembershipConfig::where('id',$id)->first();
            return view('admin.Membership.edit',compact('membership'));
        }

        public function UpdateMembership(Request $request)
        {
            $membership = MembershipConfig::where('id',$request->membershipId)->update([
                'membership_code' => $request->membershipCode,
                'membership_desc' => $request->description,
                'membership_amount' => $request->amount,
                'is_visible' => $request->isVisible,
                'year' => $request->year,
            ]);

            return redirect(route('admin.membership.list'));
        }


        public function DeleteMembership($id)
        {
            $membership = MembershipConfig::find($id);

            if($membership->delete()){
            return redirect(route('admin.membership.list'))->withSuccess('Membership Removed Successfully');


            }else{
                return redirect(route('admin.membership.list'))->withSuccess('Membership Removed Successfully');

            }
        }

}
