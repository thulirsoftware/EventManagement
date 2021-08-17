<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocationModel;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

        public function ListLocation()
        {
            $locations = LocationModel::orderby('id','desc')->get();
            return view('admin.location.list', compact('locations'));
        }

        public function AddLocation()
        {
            return view('admin.location.add');
        }

        public function SaveLocation(Request $request)
        {
            $Location = new LocationModel;
            $Location->location_name = $request->location_name;
            $Location->duration_from = $request->duration_from;
            $Location->duration_to = $request->duration_to;
            $Location->status = $request->status;
            $Location->save();
            return redirect(route('admin.location.list'));
        }

        public function EditLocation($id)
        {
            $Location = LocationModel::where('id',$id)->first();
            return view('admin.location.edit',compact('Location'));
        }

        public function UpdateLocation(Request $request)
        {
            $Location = LocationModel::find($request->LocationId);
            $Location->location_name = $request->location_name;
            $Location->duration_from = $request->duration_from;
            $Location->duration_to = $request->duration_to;
            $Location->status = $request->status;
            $Location->save();
               
            return redirect(route('admin.location.list'));
        }


        public function DeleteLocation(Request $request)
        {
            $Location = LocationModel::find($request->locationId);

            if($Location->delete()){
            return redirect(route('admin.location.list'))->withSuccess('Location Removed Successfully');


            }else{
                return redirect(route('admin.location.list'))->withSuccess('Location Removed Successfully');

            }
        }
}
