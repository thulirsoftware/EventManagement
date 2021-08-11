<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class EntryConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

        public function ListEntries()
        {
            $entries = Entry::orderby('id','desc')->get();
            return view('admin.entry.list', compact('entries'));
        }

        public function AddEntries()
        {
            return view('admin.entry.add');
        }

        public function SaveEntries(Request $request)
        {
            $Entry = new Entry;
            $Entry->min_age = $request->min_age;
            $Entry->max_age = $request->max_age;
            $Entry->member_type = $request->member_type;
            $Entry->price = $request->price;
            $Entry->save();
           return redirect()->back()->withSuccess('Entries Added Successfully');

        }

        public function EditEntries($id)
        {
            $entry = Entry::where('id',$id)->first();
            return view('admin.entry.edit',compact('entry'));
        }

        public function UpdateEntries(Request $request)
        {
            $Entry = Entry::find($request->EntryId);
             $Entry->min_age = $request->min_age;
            $Entry->max_age = $request->max_age;
            $Entry->member_type = $request->member_type;
            $Entry->price = $request->price;
            $Entry->save();
               
            return redirect(route('admin.entry.list'));
        }


        public function DeleteEntries(Request $request)
        {
            $Entry = Entry::find($request->EntryId);

            if($Entry->delete()){
            return redirect(route('admin.entry.list'))->withSuccess('Entry Removed Successfully');


            }else{
                return redirect(route('admin.entry.list'))->withSuccess('Entry Removed Successfully');

            }
        }
}
