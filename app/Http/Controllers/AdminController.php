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
use File;
use App\User;
use App\School;
use App\MembershipConfig;
use Carbon\Carbon;

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
        
        
     if ($request->hasFile('eventFlyer')){  
         
     $file = $request->file('eventFlyer');
     
     $extension = $file->getClientOriginalExtension(); 
     
     $fileName = time().'.'.$extension;
     
     $path = public_path().'/events';
     
     $uplaod = $file->move($path,$fileName);
     
     }
        
        
    //   if($request->eventFlyer != "" || $request->eventFlyer != null){

    //   $filename=$request->eventFlyer->getClientOriginalName('public/upload');

    //   $extension=$request->eventFlyer->getClientOriginalExtension('public/upload');

    //   $flyerName=bin2hex(openssl_random_pseudo_bytes(5));

    //   if($extension!=''){
    //       $flyerName.=".".$extension;
    //   }

    //   $request->eventFlyer->storeAs('/public/upload/events',$flyerName);
    //   }
       
       
       
       

        $event = new Event;
        $event->eventName = $request->eventName;
        $event->eventDescription = $request->eventDescription;

        if($request->eventFlyer != "" || $request->eventFlyer != null){
        $event->eventFlyer = $fileName;
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
    
    public function eventUpdate(Request $request)
    {

     $event = Event::find($request->id);

     if ($request->hasFile('eventFlyer')){  
         
      $deleteFlyer = public_path().'/events/'.$event->eventFlyer;

        if(File::exists($deleteFlyer)) {
        File::delete($deleteFlyer);
        }
    
     $file = $request->file('eventFlyer');
     
     $extension = $file->getClientOriginalExtension(); 
     
     $fileName = time().'.'.$extension;
     
     $path = public_path().'/events';
     
     $uplaod = $file->move($path,$fileName);
     
     }

        $event = Event::find($request->id);

            $event->eventName = $request->eventName;
            $event->eventDescription = $request->eventDescription;

            if($request->eventFlyer != "" || $request->eventFlyer != null){
            $event->eventFlyer = $fileName;
            }else{
                 $event->eventFlyer = $event['eventFlyer'];
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
    
    public function eventDelete($id)
    {
        $event = Event::find($id);

        if($event['eventFlyer'] != "" || $event['eventFlyer'] != null){
            
            $deleteFlyer = public_path().'/events/'.$event->eventFlyer;

            if(File::exists($deleteFlyer)) {
              File::delete($deleteFlyer);
            }
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

        

        public function memberDetails()
        {
            $toDay =Carbon::now()->toDateString();

            $members = Member::where('membershipExpiryDate','>=',$toDay)->get();

            return view('admin.memberDetails',compact('members'));
        }


        public function nonMemberDetails()
        {
            $toDay =Carbon::now()->toDateString();

            $members = Member::where('membershipExpiryDate','<',$toDay)->get();

            return view('admin.nonMemberDetails',compact('members'));
        }



        public function editMember($id)
        {

            $member = Member::where('id',$id)->first();
            $user = User::where('email',$member->primaryEmail)->first();

            return view('user.editMember',compact('member','user'));
        }

        public function editMemberUpdate(Request $request)
        {

            $member = Member::where('id',$request->memberId)->update([
                'firstName' => $request->firstName,
                'primaryEmail' => $request->email,
                'lastName' => $request->lastName,
            ]);

            $user = User::where('id',$request->userId)->update([
                'name' => $request->firstName,
                'email' => $request->email,
            ]);
           
            return redirect('/admin/memberDetails');
        }


        public function manageSchool()
        {
            $schools = School::all();
            return view('admin.manageSchool', compact('schools'));
        }


        public function addSchool()
        {
            return view('admin.addSchoolForm');
        }

        public function addSchoolPost(Request $request)
        {
            $school = new School;
            $school->name = $request->schoolName;
            $school->save();

            return redirect('admin/manageSchool');
        }

        public function schoolEdit($id)
        {
            $school = School::where('id',$id)->first();

            return view('admin.editSchoolForm',compact('school'));
        }

        public function schoolUpdate(Request $request)
        {

            $school = School::where('id',$request->schoolId)->update([
                'name' => $request->schoolName,
            ]);

            return redirect('/admin/manageSchool');
        }


        public function schoolDelete($id)
        {
            $school = School::find($id);

            if($school->delete()){

                return redirect()->back();

            }else{
                
                return redirect()->back();
            }
        }




        public function manageMembership()
        {
            $memberships = MembershipConfig::all();

            return view('admin.manageMembership', compact('memberships'));
        }


        public function addMembership()
        {
            return view('admin.addMembershipForm');
        }

        public function addMembershipPost(Request $request)
        {
            $membership = new MembershipConfig;
            $membership->membership_code = $request->membershipCode;
            $membership->membership_desc = $request->description;
            $membership->membership_amount = $request->amount;
            $membership->is_visible = $request->isVisible;
            $membership->open_date = $request->openDate;
            $membership->closing_date = $request->closeDate;
            $membership->save();

            return redirect('admin/manageMembership');
        }

        public function membershipEdit($id)
        {
            $membership = MembershipConfig::where('id',$id)->first();

            return view('admin.editMembershipForm',compact('membership'));
        }

        public function membershipUpdate(Request $request)
        {
            $membership = MembershipConfig::where('id',$request->membershipId)->update([
                'membership_code' => $request->membershipCode,
                'membership_desc' => $request->description,
                'membership_amount' => $request->amount,
                'is_visible' => $request->isVisible,
                'open_date' => $request->openDate,
                'closing_date' => $request->closeDate,
            ]);

            return redirect('/admin/manageMembership');
        }


        public function membershipDelete($id)
        {
            $membership = MembershipConfig::find($id);

            if($membership->delete()){

                return redirect()->back();

            }else{
                
                return redirect()->back();
            }
        }
}
