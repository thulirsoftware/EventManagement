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
use Session;
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
        if($request->has('competitionCheck'))
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
        $event->free_count = $request->free_count;
        $event->eventLocation = $request->eventLocation;
        $event->eventLocationLink = $request->eventLocationLink;

        if($event->save())
        {
            if($request->has('min_age'))
            {
                $ageGroupCount = count($request->min_age); 
            }
            else
            {
                 $ageGroupCount = 0;
            }

            for($i = 0;$i < $ageGroupCount; $i++)
            {
                $EventEntryTickets = new EventEntryTickets();
                $EventEntryTickets->eventId = $event->id;
                $EventEntryTickets->min_age = $request->min_age[$i];
                $EventEntryTickets->max_age = $request->max_age[$i];
                $EventEntryTickets->memberType =$request->memberType[$i];
                $EventEntryTickets->ticketPrice = $request->ticketPrice[$i];
                if($request->ticketPrice[$i]!=null)
                {
                    $EventEntryTickets->save();
                }
            }
            if($request->has('food_min_age'))
            {
                $FoodageGroupCount = count($request->food_min_age); 
            }
            else
            {
                 $FoodageGroupCount = 0;
            }

            for($i = 0;$i < $FoodageGroupCount; $i++)
            {
                $eventTicket = new EventTicket;
                $eventTicket->eventId = $event->id;
                $eventTicket->eventName = $event->eventName;
                $eventTicket->min_age = $request->food_min_age[$i];
                $eventTicket->max_age = $request->food_max_age[$i];
                $eventTicket->memberType =$request->FoodmemberType[$i];
                $eventTicket->foodType = $request->foodType[$i];
                $eventTicket->ticketPrice = $request->FoodticketPrice[$i];
                if($request->FoodticketPrice[$i]!=null)
                {
                    $eventTicket->save();
                }
            }    
        }
            
            Session::put('competitionChecks',$event->id);
           return redirect('/admin/addEventcompetitions');

            
        }
        else
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
        $event->free_count = $request->free_count;
        if($event->save())
        {
            if($request->has('min_age'))
            {
                $ageGroupCount = count($request->min_age); 
            }
            else
            {
                 $ageGroupCount = 0;
            }

            for($i = 0;$i < $ageGroupCount; $i++)
            {
                $EventEntryTickets = new EventEntryTickets();
                $EventEntryTickets->eventId = $event->id;
                $EventEntryTickets->min_age = $request->min_age[$i];
                $EventEntryTickets->max_age = $request->max_age[$i];
                $EventEntryTickets->memberType =$request->memberType[$i];
                $EventEntryTickets->ticketPrice = $request->ticketPrice[$i];
                if($request->ticketPrice[$i]!=null)
                {
                    $EventEntryTickets->save();
                }
            }
            if($request->has('food_min_age'))
            {
                $FoodageGroupCount = count($request->food_min_age); 
            }
            else
            {
                 $FoodageGroupCount = 0;
            }

            for($i = 0;$i < $FoodageGroupCount; $i++)
            {
                $eventTicket = new EventTicket;
                $eventTicket->eventId = $event->id;
                $eventTicket->eventName = $event->eventName;
                $eventTicket->min_age = $request->food_min_age[$i];
                $eventTicket->max_age = $request->food_max_age[$i];
                $eventTicket->memberType =$request->FoodmemberType[$i];
                $eventTicket->foodType = $request->foodType[$i];
                $eventTicket->ticketPrice = $request->FoodticketPrice[$i];
                if($request->FoodticketPrice[$i]!=null)
                {
                    $eventTicket->save();
                }
            }    
        }
                

         
        }
        return redirect('/admin/manageEvent')->withSuccess('Event Added Successfully');
    }

    public function addEventCompetitions()
    {
        $toDay = Carbon::now()->toDateString();
        $Competition=Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionModal = Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionAjax = Competition::where('closing_date','>=',$toDay)->get();
       return view('admin.event.competition_add',compact('CompetitionModal','CompetitionAjax','Competition'));
    }
    public function addEventcompetitionsSave(Request $request)
    {
       $eventId = Session::get('competitionChecks');
           
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
              
                $EventCompetition = new EventCompetition();
                $EventCompetition->event_id = $eventId;
                $EventCompetition->competition_id = $request->competition_id[$i];
                $EventCompetition->member_fee = $request->member_fee[$i];
                $EventCompetition->non_member_fee = $request->non_member_fee[$i];
                if($EventCompetition->save())
                {

                }
                else
                {
                    $Event = Event::where('id',$eventId)->delete();
                }
            }  
        Session::forget('competitionChecks');
         return redirect('/admin/manageEvent')->withSuccess('Event Added Successfully');
    }

    public function addEventEntryTicket($id)
    {
        return view('admin.event.addEventEntryTicket',compact('id'));
    }
    public function addEventEntryTicketPost(Request $request)
    {
        $eventTicket = new EventEntryTickets();
        $eventTicket->eventId = $request->eventId;
        $eventTicket->min_age = $request->min_age;
        $eventTicket->max_age = $request->max_age;
        $eventTicket->memberType =$request->memberType;
        $eventTicket->ticketPrice = $request->ticketPrice;
        $eventTicket->save();
         return redirect(url('admin/eventTickets/'.$request->eventId))->withInput(["tab" =>"nav-profile"])->withSuccess('Entry Ticket Added Successfully');
    }

    public function addEventFoodTicket($id)
    {
        return view('admin.event.addEventFoodTicket',compact('id'));
    }
    public function addEventFoodTicketPost(Request $request)
    {
        $eventTicket = new EventTicket();
        $eventTicket->eventId = $request->eventId;
        $eventTicket->min_age = $request->min_age;
        $eventTicket->max_age = $request->max_age;
        $eventTicket->memberType =$request->FoodmemberType;
        $eventTicket->foodType = $request->foodType;
        $eventTicket->ticketPrice = $request->FoodticketPrice;
        $eventTicket->save();
         return redirect(url('admin/eventTickets/'.$request->eventId))->withInput(["tab" =>"nav-contact"])->withSuccess('Food Ticket Added Successfully');

    }

    public function addEventCompetition($id)
    {
       $toDay = Carbon::now()->toDateString();
        $Competition=Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionAjax=Competition::where('closing_date','>=',$toDay)->get();
        return view('admin.event.addEventCompetition',compact('id','Competition','CompetitionAjax'));
    }
    public function addEventCompetitionPost(Request $request)
    {
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
                
                $EventCompetition = new EventCompetition();
                $EventCompetition->event_id = $request->id;
                $EventCompetition->competition_id = $request->competition_id[$i];
                $EventCompetition->member_fee = $request->member_fee[$i];
                $EventCompetition->non_member_fee = $request->non_member_fee[$i];
                $EventCompetition->save();
            }  
         return redirect(url('admin/eventTickets/'.$request->id))->withInput(["tab" =>"nav-competition"])->withSuccess('Competition Added Successfully');
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

                       return redirect(url('admin/eventTickets/'.$request->id))->withInput(["tab" =>"nav-home"])->withSuccess('Event Updated Successfully');

            
            }else{

                    return redirect(url('admin/eventTickets/'.$request->id))->withInput(["tab" =>"nav-home"])->withSuccess('Event Updated Successfully');

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


   

    public function eventTicketDelete(Request $request)
    {
        $eventTicket = EventEntryTickets::find($request->id);
        if($eventTicket->delete()){

             return response()->json(['success'=>$eventTicket]);


        }else{
            
          return response()->json(['success'=>$eventTicket]);

        }
    }

    public function EventFoodTicketDelete(Request $request)
    {
        $eventTicket = EventTicket::find($request->id);
        if($eventTicket->delete()){

             return response()->json(['success'=>$eventTicket]);


        }else{
            
          return response()->json(['success'=>$eventTicket]);

        }
    }

    public function manageEvent()
    {
        $events = Event::orderby('id','desc')->get();
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
        $eventTicket->min_age = $request['event_min_age'];
        $eventTicket->max_age = $request['event_max_age'];
        $eventTicket->memberType =$request['event_type'];
        $eventTicket->foodType = $request['event_food'];
        $eventTicket->ticketPrice = $request['event_price'];
        $eventTicket->save();

        return response()->json(['success'=>$eventTicket]);
    }
    public function UpdateEventEntryTicket(Request $request)
    {
         $eventTicket = EventEntryTickets::find($request['event_entry_id']);
        $eventTicket->min_age = $request['event_min_age'];
        $eventTicket->max_age = $request['event_max_age'];
        $eventTicket->memberType =$request->event_type;
        $eventTicket->ticketPrice = $request->event_price;
        $eventTicket->save();
        return response()->json(['success'=>$eventTicket]);
    }

     public function UpdateCompetition(Request $request)
    {
        $Competition = EventCompetition::find($request->event_competition_id);
        $Competition->member_fee = $request->competition_fee;
        $Competition->non_member_fee = $request->competition_nonfee;
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
