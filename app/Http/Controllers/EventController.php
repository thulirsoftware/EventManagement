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
use App\PurchasedEventEntryTickets;
use App\PurchasedEventFoodTickets;
use App\CompetitionRegistered;
use App\LocationModel;
use App\CompetitionLocations;
use App\FoodModel;
use App\Entry;

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
        $FoodTypes = FoodModel::get();
        $Entry = Entry::get();
        return view('admin.event.addEventForm',compact('Competition','CompetitionModal','CompetitionAjax','FoodTypes','Entry'));
    }

    public function addEventPost(Request $request)
    { 
        Session::put('eventsCompetition',$request->all());

        if($request->has('competitionCheck'))
        {
  
             if ($request->hasFile('eventFlyer')){  
                 
             $file = $request->file('eventFlyer');
             
             $extension = $file->getClientOriginalExtension(); 
             
             $fileName = time().'.'.$extension;
             
             $path = public_path().'/events';
             
             $uplaod = $file->move($path,$fileName);
            Session::put('eventsFlyer',$fileName); 

             }   
                
           
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
            if($request->has('entry_id'))
            {
                $entry_idCount = count($request->entry_id); 
            }
            else
            {
                 $entry_idCount = 0;
            }

            for($i = 0;$i < $entry_idCount; $i++)
            {
                $Entry = Entry::where('id',$request->entry_id[$i])->first();

                $EventEntryTickets = new EventEntryTickets();
                $EventEntryTickets->eventId = $event->id;
                $EventEntryTickets->entry_id = $Entry->id;
                $EventEntryTickets->min_age = $Entry->min_age;
                $EventEntryTickets->max_age = $Entry->max_age;
                $EventEntryTickets->memberType =$Entry->member_type;
                $EventEntryTickets->ticketPrice = $Entry->price;
                if($Entry->price!=null)
                {
                    $EventEntryTickets->save();
                }
            }
            if($request->has('food_id'))
            {
                $food_idCount = count($request->food_id); 
            }
            else
            {
                 $food_idCount = 0;
            }

            for($i = 0;$i < $food_idCount; $i++)
            {
                $food = FoodModel::where('id',$request->food_id[$i])->first();

                $eventTicket = new EventTicket;
                $eventTicket->eventId = $event->id;
                $eventTicket->eventName = $event->eventName;
                $eventTicket->min_age = $food->min_age;
                $eventTicket->max_age = $food->max_age;
                $eventTicket->memberType =$food->memberType;
                $eventTicket->foodType = $food->food_type;
                $eventTicket->ticketPrice = $food->price;
                if($request->ticketPrice!=null)
                {
                    $eventTicket->save();
                }
            }    
        }
                

         
        }
        return redirect('/admin/manageEvent')->withSuccess('Event Added Successfully');
    }

    public function addEventCompetitions($id)
    {
        $toDay = Carbon::now()->toDateString();
        $Competition=Competition::where('closing_date','>=',$toDay)->get();
        $locations = LocationModel::where('status','Y')->get();

        $CompetitionModal = Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionAjax = Competition::where('closing_date','>=',$toDay)->get();
       return view('admin.event.competition_add',compact('CompetitionModal','CompetitionAjax','Competition','locations'));
    }
    public function addEventcompetitionsSave(Request $request)
    {
        $Events = Session::get('eventsCompetition');
        $fileName = Session::get('eventsFlyer'); 
        $event = new Event;
        $event->eventName = $Events['eventName'];
        $event->eventFlyer = $fileName;
        $event->eventDate = $Events['eventDate'];
        $event->eventTime = $Events['eventTime'];
        $event->free_count = $Events['free_count'];
        $event->eventLocation = $Events['eventLocation'];

        if($event->save())
        {
            if(array_key_exists('entry_id',$Events))
            {
                $entry_idCount = count($Events['entry_id']); 
            }
            else
            {
                 $entry_idCount = 0;
            }

            for($i = 0;$i < $entry_idCount; $i++)
            {
                $Entry = Entry::where('id',$Events['entry_id'][$i])->first();

                $EventEntryTickets = new EventEntryTickets();
                $EventEntryTickets->eventId = $event->id;
                $EventEntryTickets->entry_id = $Entry->id;
                $EventEntryTickets->min_age = $Entry->min_age;
                $EventEntryTickets->max_age = $Entry->max_age;
                $EventEntryTickets->memberType =$Entry->member_type;
                $EventEntryTickets->ticketPrice = $Entry->price;
                if($Entry->price!=null)
                {
                    $EventEntryTickets->save();
                }
            }
            if(array_key_exists('food_id',$Events))
            {
                $FoodageGroupCount = count($Events['food_id']); 
            }
            else
            {
                 $FoodageGroupCount = 0;
            }

            for($i = 0;$i < $FoodageGroupCount; $i++)
            {
                 $food = FoodModel::where('id',$Events['food_id'][$i])->first();

                $eventTicket = new EventTicket;
                $eventTicket->food_id = $food->id;
                $eventTicket->eventId = $event->id;
                $eventTicket->eventName = $event->eventName;
                $eventTicket->min_age = $food->min_age;
                $eventTicket->max_age = $food->max_age;
                $eventTicket->memberType =$food->memberType;
                $eventTicket->foodType = $food->food_type;
                $eventTicket->ticketPrice = $food->price;
                if($food->price!=null)
                {
                    $eventTicket->save();
                }

               
            }    
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
              
                $EventCompetition = new EventCompetition();
                $EventCompetition->event_id = $event->id;;
                $EventCompetition->competition_id = $request->competition_id[$i];
                $EventCompetition->member_fee = $request->member_fee[$i];
                $EventCompetition->non_member_fee = $request->non_member_fee[$i];
                $EventCompetition->save();
               
                
            }  

                    if($request->has('location'))
                    {
                        $CompetitionLocations_Count = count($request->location); 
                    }
                    else
                    {
                         $CompetitionLocations_Count = 0;
                    }
                    for($i = 0;$i < $CompetitionLocations_Count; $i++)
                    {
                        $pieces = explode("_", $request->location[$i]);
                        $competition_id = $pieces[0];
                        $location_id = $pieces[1];                      
                        $CompetitionLocations = new CompetitionLocations();
                        $CompetitionLocations->event_id = $event->id;
                        $CompetitionLocations->competition_id = $competition_id;
                        $CompetitionLocations->location_id = $location_id;
                       $CompetitionLocations->save();
                    }

            Session::forget('eventsCompetition');
            Session::forget('eventsFlyer');
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
       $competition_added = EventCompetition::where('event_id',$id)->pluck('competition_id');
        $Competition=Competition::where('closing_date','>=',$toDay)->whereNotIn('id',$competition_added)->get();
        $CompetitionId=Competition::where('closing_date','>=',$toDay)->pluck('id');
        $Locations = LocationModel::get();
        return view('admin.event.addEventCompetition',compact('id','Competition','CompetitionId','CompetitionLocations','Locations'));
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
                $EventCompetition->event_id = $request->id;;
                $EventCompetition->competition_id = $request->competition_id[$i];
                $EventCompetition->member_fee = $request->member_fee[$i];
                $EventCompetition->non_member_fee = $request->non_member_fee[$i];
                $EventCompetition->save();
               
            }

            if($request->has('location'))
                    {
                        $CompetitionLocations_Count = count($request->location); 
                    }
                    else
                    {
                         $CompetitionLocations_Count = 0;
                    }
                    for($i = 0;$i < $CompetitionLocations_Count; $i++)
                    {
                        $pieces = explode("_", $request->location[$i]);
                        $competition_id = $pieces[0];
                        $location_id = $pieces[1];          
                      
                        $CompetitionLocations = new CompetitionLocations();
                        $CompetitionLocations->event_id = $request->id;
                        $CompetitionLocations->competition_id =  $competition_id;
                        $CompetitionLocations->location_id = $location_id;
                       $CompetitionLocations->save();
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
        $eventId = Session::get('competitionChecks');

        $eventTicket = EventEntryTickets::where('eventId',$eventId)->count();
        $eventFoodTicket = EventTicket::where('eventId',$eventId)->count();
        $EventCompetition = EventCompetition::where('event_id',$eventId)->count();
       
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

        $Purchased_Entry_Tickets = PurchasedEventEntryTickets::where('eventId',$id)->get();

        $Purchased_Food_Tickets = PurchasedEventFoodTickets::where('eventId',$id)->get();

        $CompetitionRegistration = CompetitionRegistered::where('event_id',$id)->get();

         return view('admin.event.tickets',compact('eventFoodTicket','eventTicket','Competition','events','event','id','Purchased_Entry_Tickets','Purchased_Food_Tickets','CompetitionRegistration'));
    }
     public static function getEventTickets($eventId,$agegroup,$membertype,$age)
    {
        $EventEntryTickets = EventEntryTickets::where('eventId',$eventId)->where('memberType',$membertype)->where('max_age',$agegroup,$age)->pluck('id');


        $EventEntryTickets = PurchasedEventEntryTickets::whereIn('ticketId',$EventEntryTickets)->count();

        return $EventEntryTickets;
    }

    public static function getFoodTickets($eventId,$agegroup,$membertype,$foodtype,$age)
    {
        $eventticket = EventTicket::where('eventId',$eventId)->where('memberType',$membertype)->where('max_age',$agegroup,$age)->where('foodType',$foodtype)->pluck('id');

        $eventticket = PurchasedEventFoodTickets::whereIn('ticketId',$eventticket)->count();

        return $eventticket;
    }
    public static function getParticipantCounts($eventId,$competition_id)
    {
        $CompetitionRegistered = CompetitionRegistered::where('eventId',$eventId)->where('competition_id',$competition_id)->count();
        return $CompetitionRegistered;
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

    public function EditEventCompetition($id)
    {
        $EventCompetition = EventCompetition::where('competition_id',$id)->first();
        $CompetitionLocations = CompetitionLocations::where('competition_id',$id)->groupBy('location_id')->pluck('location_id');
        $AddedLocations = LocationModel::whereIn('id',$CompetitionLocations)->get();
        $Locations = LocationModel::whereNotIn('id',$CompetitionLocations)->get();
        return view('admin.event.editEventCompetition',compact('EventCompetition','CompetitionLocations','id','AddedLocations','Locations'));
    }

    public function UpdateCompetition(Request $request)
    {
         CompetitionLocations::where('competition_id',$request->competition_id)->delete();

        $Competition = EventCompetition::where('competition_id',$request->competition_id)->first();
        $Competition->member_fee = $request->member_fee;
        $Competition->non_member_fee = $request->non_member_fee;
        $Competition->save();

        if($request->has('location'))
        {
            $CompetitionLocations_Count = count($request->location); 
        }
        else
        {
            $CompetitionLocations_Count = 0;
        }
        for($i = 0;$i < $CompetitionLocations_Count; $i++)
        {

            $CompetitionLocations = new CompetitionLocations();
            $CompetitionLocations->event_id = $request->eventId;
            $CompetitionLocations->competition_id = $request->competition_id;
            $CompetitionLocations->location_id =$request->location[$i];
            $CompetitionLocations->save();
        }

        return redirect(url('admin/eventTickets/'.$request->eventId))->withInput(["tab" =>"nav-competition"])->withSuccess('Competition Update Successfully');
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

    /*** Event Duplication****/

     public function createDuplicateEvent($id)
     {
        $events = Event::where('id',$id)->first();
        $FoodTickets = EventTicket::where('eventId',$id)->get();
         $eventFoodIds = EventTicket::where('eventId',$id)->pluck('food_id');
        $FoodTypes = FoodModel::whereNotIn('id',$eventFoodIds)->get();
        $FoodTicketsCount = count($FoodTickets); 
        $EntryTickets = EventEntryTickets::where('eventId',$id)->get();
        $EntryCount = count($EntryTickets);

        $eventEntryIds = EventEntryTickets::where('eventId',$id)->pluck('entry_id');
        $Entry = Entry::whereNotIn('id',$eventEntryIds)->get(); 
        $EventCompetitions = EventCompetition::where('event_id',$id)->get();
        $EventCompetitionsCount = count($EventCompetitions); 

        return view('admin.event.create_duplicate_event',compact('events','FoodTickets','FoodTicketsCount','EntryTickets','EntryCount','EventCompetitions','EventCompetitionsCount','FoodTypes','Entry'));


     }

   public function addDuplicateEventPost(Request $request)
    { 
        if($request->has('competitionCheck'))
        {
            $eventId = $request->eventId;
            Session::put('eventsCompetition',$request->all());
             if ($request->hasFile('eventFlyer')){  
                 
             $file = $request->file('eventFlyer');
             
             $extension = $file->getClientOriginalExtension(); 
             
             $fileName = time().'.'.$extension;
             
             $path = public_path().'/events';
             
             $uplaod = $file->move($path,$fileName);
             Session::put('eventsFlyer',$fileName);
             Session::put('eventId',$eventId);
             } 
           return redirect('/admin/addDuplicateEventcompetitions/'.$eventId);
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
            if($request->has('entry_id'))
            {
                $ageGroupCount = count($request->entry_id); 
            }
            else
            {
                 $ageGroupCount = 0;
            }

            for($i = 0;$i < $ageGroupCount; $i++)
            {
                $Entry = Entry::where('id',$request->entry_id[$i])->first();

                $EventEntryTickets = new EventEntryTickets();
                $EventEntryTickets->eventId = $event->id;
                $EventEntryTickets->entry_id = $Entry->id;
                $EventEntryTickets->min_age = $Entry->min_age;
                $EventEntryTickets->max_age = $Entry->max_age;
                $EventEntryTickets->memberType =$Entry->member_type;
                $EventEntryTickets->ticketPrice = $Entry->price;
                if($Entry->price!=null)
                {
                    $EventEntryTickets->save();
                }
            }
            if($request->has('food_id'))
            {
                $food_idCount = count($request->food_id); 
            }
            else
            {
                 $food_idCount = 0;
            }

            for($i = 0;$i < $food_idCount; $i++)
            {
                $food = FoodModel::where('id',$request->food_id[$i])->first();

                $eventTicket = new EventTicket;
                $eventTicket->food_id = $food->id;
                $eventTicket->eventId = $event->id;
                $eventTicket->eventName = $event->eventName;
                $eventTicket->min_age = $food->min_age;
                $eventTicket->max_age = $food->max_age;
                $eventTicket->memberType =$food->memberType;
                $eventTicket->foodType = $food->food_type;
                $eventTicket->ticketPrice = $food->price;
                if($food->price!=null)
                {
                    $eventTicket->save();
                }
            }    
        }
                

         
        }
        return redirect('/admin/manageEvent')->withSuccess('Event Added Successfully');
    }

    public function addDuplicateEventcompetitions($id)
    {
        $eventId = $id;
        $EventCompetitions = EventCompetition::where('event_id',$eventId)->get();
        $CompetitionLocations = CompetitionLocations::where('event_id',$eventId)->get();
        $EventCompetitionFound = EventCompetition::where('event_id',$eventId)->pluck('competition_id');

        $toDay = Carbon::now()->toDateString();
        $Competition=Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionModal = Competition::where('closing_date','>=',$toDay)->get();
        $CompetitionAjax = Competition::where('closing_date','>=',$toDay)->get();
       return view('admin.event.duplicate_competition_add',compact('CompetitionModal','CompetitionAjax','Competition','EventCompetitions','CompetitionLocations'));
    }
    public function addDuplicateEventcompetitionsSave(Request $request)
    {
        $Events = Session::get('eventsCompetition');
        $fileName = Session::get('eventsFlyer'); 
        $event = new Event;
        $event->eventName = $Events['eventName'];
        $event->eventFlyer = $fileName;
        $event->eventDate = $Events['eventDate'];
        $event->eventTime = $Events['eventTime'];
        $event->free_count = $Events['free_count'];
        $event->eventLocation = $Events['eventLocation'];

        if($event->save())
        {
            if(array_key_exists('entry_id',$Events))
            {
                $ageGroupCount = count($Events['entry_id']); 
            }
            else
            {
                 $ageGroupCount = 0;
            }

            for($i = 0;$i < $ageGroupCount; $i++)
            {
                $Entry = Entry::where('id',$Events['entry_id'][$i])->first();

                $EventEntryTickets = new EventEntryTickets();
                $EventEntryTickets->eventId = $event->id;
                $EventEntryTickets->entry_id = $Entry->id;
                $EventEntryTickets->min_age = $Entry->min_age;
                $EventEntryTickets->max_age = $Entry->max_age;
                $EventEntryTickets->memberType =$Entry->member_type;
                $EventEntryTickets->ticketPrice = $Entry->price;
                if($Entry->price!=null)
                {
                    $EventEntryTickets->save();
                }
            }
            if(array_key_exists('food_id',$Events))
            {
                $FoodageGroupCount = count($Events['food_id']); 
            }
            else
            {
                 $FoodageGroupCount = 0;
            }

            for($i = 0;$i < $FoodageGroupCount; $i++)
            {
                $food = FoodModel::where('id',$Events['food_id'][$i])->first();

                $eventTicket = new EventTicket;
                 $eventTicket->food_id = $food->id;
                  $eventTicket->eventId = $event->id;
                $eventTicket->eventName = $event->eventName;
                $eventTicket->min_age = $food->min_age;
                $eventTicket->max_age = $food->max_age;
                $eventTicket->memberType =$food->memberType;
                $eventTicket->foodType = $food->food_type;
                $eventTicket->ticketPrice = $food->price;
                if($food->price!=null)
                {
                    $eventTicket->save();
                }
            }    
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
              
                $EventCompetition = new EventCompetition();
                $EventCompetition->event_id = $event->id;;
                $EventCompetition->competition_id = $request->competition_id[$i];
                $EventCompetition->member_fee = $request->member_fee[$i];
                $EventCompetition->non_member_fee = $request->non_member_fee[$i];
                $EventCompetition->save();
               
            }
             if($request->has('location'))
                    {
                        $CompetitionLocations_Count = count($request->location); 
                    }
                    else
                    {
                         $CompetitionLocations_Count = 0;
                    }
                    for($i = 0;$i < $CompetitionLocations_Count; $i++)
                    {
                        $pieces = explode("_", $request->location[$i]);
                        $competition_id = $pieces[0];
                        $location_id = $pieces[1];                      
                        $CompetitionLocations = new CompetitionLocations();
                        $CompetitionLocations->event_id = $event->id;
                        $CompetitionLocations->competition_id = $competition_id;
                        $CompetitionLocations->location_id = $location_id;
                       $CompetitionLocations->save();
                    }
   
        Session::forget('eventsCompetition');
         return redirect('/admin/manageEvent')->withSuccess('Event Added Successfully');
    }

}
