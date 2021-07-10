<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\EventTicket;
use App\EventEntryTickets;
use App\Competition;
use Hash;
use Storage;
use DB;
use Carbon\Carbon;
use App\EventCompetition;
class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function addEvent()
    {
        $toDay = Carbon::now()->toDateString();
        $Competition=Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionModal = Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionAjax = Competition::where('closing_date','>=',$toDay)->get();
        return view('admin.event.addEventForm',compact('Competition','CompetitionModal','CompetitionAjax'));
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

        if($event->save())
        {
            $EventEntryTickets = new EventEntryTickets();
            $EventEntryTickets->eventId = $event->id;
            $EventEntryTickets->ageGroup = $request->ageGroup;
            $EventEntryTickets->memberType =$request->memberType;
            $EventEntryTickets->ticketPrice = $request->ticketPrice;
            $EventEntryTickets->ticketQty = $request->number_of_tickets;
            if($request->ticketPrice!=null)
            {
                $EventEntryTickets->save();
            }

            $eventTicket = new EventTicket;
            $eventTicket->eventId = $event->id;
            $eventTicket->eventName = $event->eventName;
            $eventTicket->ageGroup = $request->FoodageGroup;
            $eventTicket->memberType =$request->FoodmemberType;
            $eventTicket->foodType = $request->foodType;
            $eventTicket->ticketPrice = $request->FoodticketPrice;
            $eventTicket->ticketQty = $request->Food_number_of_tickets;
            if($request->FoodticketPrice!=null)
            {
                $eventTicket->save();
            }
            if($request->has('competition_id'))
            {
                $competition_Count = count($request->competition_id); 
            }
            else
            {
                 $competition_Count = 0;
            }
            for($i = 0;$i < $competition_Count; $i++)
            {
                $Competition = Competition::find($request->competition_id[$i]);
                $Competition->member_fee = $request->member_fee[$i];
                $Competition->non_member_fee = $request->non_member_fee[$i];
                $Competition->starting_date = $request->start_date[$i];
                $Competition->closing_date = $request->closing_date[$i];
                $Competition->save();

                $EventCompetition = new EventCompetition();
                $EventCompetition->event_id = $event->id;
                $EventCompetition->competition_id = $request->competition_id[$i];
                $EventCompetition->save();
            }
            
            

         
        }
        return redirect('/admin/manageEvent')->withSuccess('Event Added Successfully');
    }

    public function addEventEntryTicket()
    {
        $eventId = Event::whereRaw('id = (select max(`id`) from events)')->get();
        $eventId = $eventId[0];

        $eventTicket = EventEntryTickets::where('eventId',$eventId['id'])->get();

        return view('admin.event.addEventEntryTicket',compact('eventId','eventTicket'));
    }
    public function addEventEntryTicketPost(Request $request)
    {
        $eventTicket = new EventEntryTickets();
        $eventTicket->eventId = $request->eventId;
        $eventTicket->ageGroup = $request->ageGroup;
        $eventTicket->memberType =$request->memberType;
        $eventTicket->ticketPrice = $request->ticketPrice;
        $eventTicket->save();
         return redirect(url('admin/addEventTicket'));
    }
      public function addEventTicketPost(Request $request)
    {   
        $eventTicket = new EventTicket;
        $eventTicket->eventId = $request->eventId;
        $eventTicket->eventName = $request->eventName;
        $eventTicket->ageGroup = $request->ageGroup;
        $eventTicket->memberType =$request->memberType;
        $eventTicket->foodType = $request->foodType;
        $eventTicket->ticketPrice = $request->ticketPrice;
        $eventTicket->save();
         return redirect()->back()->withSuccess('Event Ticket Added Successfully');

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

                        return redirect('/admin/manageEvent')->withSuccess('Event Updated Successfully');

            
            }else{

                         return redirect('/admin/manageEvent')->withSuccess('Event Updated Successfully');

            }
    }
    
    public function eventDelete(Request $request)
    {
        $event = Event::find($request->id);

        if($event['eventFlyer'] != "" || $event['eventFlyer'] != null){
            
            $deleteFlyer = public_path().'/events/'.$event->eventFlyer;

          
        }

        $eventTicket = DB::table('event_entry_tickets')->where('eventId',$request->id)->get();

        if($eventTicket != "" || $eventTicket != null){
            $eventTicket = DB::table('event_entry_tickets')->where('eventId',$request->id)->delete();
        }
        
        $eventFoodTicket = DB::table('event_food_tickets')->where('eventId',$request->id)->get();

        if($eventFoodTicket != "" || $eventFoodTicket != null){
            $eventFoodTicket = DB::table('event_food_tickets')->where('eventId',$request->id)->delete();
        }

        if($event->delete()){

           echo json_encode($request->id); 



        }else{
            
            echo json_encode($request->id); 

        }
    }
    public function addEventTicket()
    {
        $eventId = Event::whereRaw('id = (select max(`id`) from events)')->get();
        $eventId = $eventId[0];

        $eventTicket = EventTicket::where('eventId',$eventId['id'])->get();

        return view('admin.event.addEventTicket',compact('eventId','eventTicket'));
    }


   

    public function eventTicketDelete($id)
    {
        $eventTicket = EventTicket::find($id);

        if($eventTicket->delete()){

                     return redirect()->back()->withSuccess('Event Ticket Removed Successfully');


        }else{
            
                     return redirect()->back()->withSuccess('Event Ticket Removed Successfully');

        }
    }

    public function manageEvent()
    {
        $events = Event::all();
        return view('admin.event.manageEvent',compact('events'));
    }

    public function eventTickets($id)
    {
        $eventTicket = EventEntryTickets::where('eventId',$id)->get();
        $eventFoodTicket = EventTicket::where('eventId',$id)->get();
        $EventCompetition = EventCompetition::where('event_id',$id)->pluck('competition_id');
        $Competition = Competition::whereIn('id',$EventCompetition)->get();
        $events = Event::where('id',$id)->first();
                $event = Event::where('id',$id)->first();

         return view('admin.event.tickets',compact('eventFoodTicket','eventTicket','Competition','events','event'));
    }

    public function UpdateEventFoodTicket(Request $request)
    {
        $eventTicket = EventTicket::find($request['event_food_id']);
        $eventTicket->ageGroup = $request['event_age'];
        $eventTicket->memberType =$request['event_type'];
        $eventTicket->foodType = $request['event_food'];
        $eventTicket->ticketPrice = $request['event_price'];
         $eventTicket->ticketQty = $request['quantity'];
        $eventTicket->save();

        return response()->json(['success'=>$eventTicket]);
    }
    public function UpdateEventEntryTicket(Request $request)
    {
         $eventTicket = EventEntryTickets::find($request['event_entry_id']);
        $eventTicket->ageGroup = $request->event_age;
        $eventTicket->memberType =$request->event_type;
        $eventTicket->ticketPrice = $request->event_price;
        $eventTicket->save();
        return response()->json(['success'=>$eventTicket]);
    }

     public function UpdateCompetition(Request $request)
    {
        $Competition = Competition::find($request->event_competition_id);
        $Competition->starting_date = $request->competition_sdate;
        $Competition->member_fee = $request->competition_fee;
        $Competition->non_member_fee = $request->competition_nonfee;
        $Competition->closing_date = $request->competition_cdate;
        $Competition->save();
        return response()->json(['success'=>$Competition]);
    }

    public function DeleteEventCompetition(Request $request)
    {
        $EventCompetition = EventCompetition::where('competition_id',$request->id)->delete();
        return response()->json(['success'=>$EventCompetition]);
    }

    public function editEventTicket($id)
    {   
        $event = Event::where('id',$id)->get()->toArray();
        $eventTicket = EventTicket::where('eventId',$id)->get();

        return view('admin.event.eventTicketEditForm',compact('event','eventTicket'));
    }

     public function editEventEntryTicket($id)
    {   
        $event = Event::where('id',$id)->get()->toArray();
        $eventTicket = EventEntryTickets::where('eventId',$id)->get();

        return view('admin.event.eventEntryTicketEditForm',compact('event','eventTicket'));
    }

    public function addEventEntryTicketUpdate(Request $request)
    {
        $eventTicket = new EventEntryTickets();
        $eventTicket->eventId = $request->eventId;
        $eventTicket->ageGroup = $request->ageGroup;
        $eventTicket->memberType =$request->memberType;
        $eventTicket->ticketPrice = $request->ticketPrice;
        $eventTicket->save();
         return redirect()->back()->withSuccess('Event Entry Ticket Added Successfully');

    }



        public function eventEdit($id)
        {
            $event['event'] = Event::find($id);
            return view('admin.event.eventEditForm',$event);
        }

        
}
