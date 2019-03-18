<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Event;
use App\EventTicket;
use Hash;
use Storage;
use DB;
use App\Member;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function admin_edit_profile()
    {
        return view('admin.admin_edit_profile');
    }
    
   
    
    public function addedtickets()
    {
        return view('admin.addedtickets');
    }


    public function addAdmin()
    {
        return view('admin.addAdminForm');
    }

    public function addAdminPost(Request $request)
    {
        //dd($request->all());
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->job_title = $request->role;
        $admin->email = $request->userName;
        $admin->is_active = $request->is_active;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back();
    }

    public function manageAdmin()
    {
        $admins = Admin::all();
        return view('admin.manageAdmin',compact('admins'));
    }

    public function adminEdit($id)
    {
        $admin['admin'] = Admin::find($id);

        return view('admin.addAdminEditForm',$admin);
    }

    public function adminUpdate(Request $request)
    {
        $admin = Admin::find($request->id);
//dd($admin);
            $admin->name = $request->name;
            $admin->email = $request->userName;
            $admin->is_active = $request->isActive;
            $admin->job_title = $request->role;
            $admin->password = Hash::make($request->password);

            if($admin->save()){

               return redirect('/admin/manageAdmin');
            
            }else{

                return redirect('/admin/manageAdmin');
            }
    }

    public function adminDelete($id)
    {
        $admin = Admin::find($id);

        if($admin->delete()){

            return redirect('/admin/manageAdmin');

        }else{
            
            return redirect('/admin/manageAdmin');
        }
    }







    public function addEvent()
    {
        return view('admin.addEventForm');
    }

    public function addEventPost(Request $request)
    {   
        //dd($request->all());
       if($request->eventFlyer != "" || $request->eventFlyer != null){

       $filename=$request->eventFlyer->getClientOriginalName('public/upload');

       $extension=$request->eventFlyer->getClientOriginalExtension('public/upload');

       $flyerName=bin2hex(openssl_random_pseudo_bytes(5));

       if($extension!=''){
           $flyerName.=".".$extension;
       }

       $request->eventFlyer->storeAs('/public/upload/events',$flyerName);
       }

        $event = new Event;
        $event->eventName = $request->eventName;
        $event->eventDescription = $request->eventDescription;

        if($request->eventFlyer != "" || $request->eventFlyer != null){
        $event->eventFlyer = $flyerName;
        }else{
             $event->eventFlyer = $request->eventFlyer;
        }

        $event->eventDate = $request->eventDate;
        $event->eventTime = $request->eventTime;
        $event->eventLocation = $request->eventLocation;
        $event->eventLocationLink = $request->eventLocationLink;
        $event->save();

        return redirect(url('admin/addEventTicket'));
    }

    public function addEventTicket()
    {
        $eventId = Event::whereRaw('id = (select max(`id`) from events)')->get();
        $eventId = $eventId[0];

        $eventTicket = EventTicket::where('eventId',$eventId['id'])->get();

        return view('admin.addEventTicket',compact('eventId','eventTicket'));
    }


    public function addEventTicketPost(Request $request)
    {   
        $eventTicket = new EventTicket;
        $eventTicket->eventId = $request->eventId;
        $eventTicket->eventName = $request->eventName;
        $eventTicket->ageGroup = $request->ageGroup;
        $eventTicket->memberType =$request->memberType;
        $eventTicket->foodType = $request->foodType;
        $eventTicket->dateRange = $request->dateRange;
        $eventTicket->ticketPrice = $request->ticketPrice;
        $eventTicket->save();

        return redirect()->back();
    }

    public function eventTicketDelete($id)
    {
        $eventTicket = EventTicket::find($id);

        if($eventTicket->delete()){

            return redirect()->back();

        }else{
            
            return redirect()->back();
        }
    }

    public function manageEvent()
    {
        $events = Event::all();
        return view('admin.manageEvent',compact('events'));
    }

    public function eventDelete($id)
    {
        $event = Event::find($id);

        if($event->eventFlyer != "" || $event->eventFlyer != null){

            Storage::delete('public/upload/events/'.$event->eventFlyer);
        }

        $eventTicket = DB::table('event_tickets')->where('eventId',$id)->get();

        if($eventTicket != "" || $eventTicket != null){
            $eventTicket = DB::table('event_tickets')->where('eventId',$id)->delete();
        }

        if($event->delete()){

            return redirect()->back();

        }else{
            
            return redirect()->back();
        }
    }

    public function editEventTicket($id)
    {   
        $event = Event::where('id',$id)->get()->toArray();
        $eventTicket = EventTicket::where('eventId',$id)->get();

        return view('admin.eventTicketEditForm',compact('event','eventTicket'));
    }


        public function eventEdit($id)
        {
            $event['event'] = Event::find($id);
            return view('admin.eventEditForm',$event);
        }

        public function eventUpdate(Request $request)
        {

            $event = Event::find($request->id);

            if($request->eventFlyer != "" || $request->eventFlyer != null){

            Storage::delete('public/upload/events/'.$event->eventFlyer);

            $filename=$request->eventFlyer->getClientOriginalName('public/upload');

            $extension=$request->eventFlyer->getClientOriginalExtension('public/upload');

            $flyerName=bin2hex(openssl_random_pseudo_bytes(5));

            if($extension!=''){
                $flyerName.=".".$extension;
            }

            $request->eventFlyer->storeAs('/public/upload/events',$flyerName);
            }




            $event = Event::find($request->id);

                $event->eventName = $request->eventName;
                $event->eventDescription = $request->eventDescription;

                if($request->eventFlyer != "" || $request->eventFlyer != null){
                $event->eventFlyer = $flyerName;
                }else{
                     $event->eventFlyer = $request->eventFlyer;
                }

                $event->eventDate = $request->eventDate;
                $event->eventTime = $request->eventTime;
                $event->eventLocation = $request->eventLocation;
                $event->eventLocationLink = $request->eventLocationLink;

                if($event->save()){

                   return redirect('/admin/manageEvent');
                
                }else{

                    return redirect('/admin/manageEvent');
                }
        }

        public function memberDetails()
        {
            $members = Member::all();

            return view('admin.memberDetails',compact('members'));
        }

}
