<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Event;
use Illuminate\Http\Request;
use App\EventTicket;
use App\EventEntryTickets;
use App\Competition;
use Carbon\Carbon;
use App\EventCompetition;
use Session;
use App\CompetitionLocations;
use App\FoodModel;
use App\Entry;
use File;

class EventDuplicationController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

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
        $Competition=Competition::whereNotIn('id',$EventCompetitionFound)->get();
        $CompetitionModal = Competition::whereNotIn('id',$EventCompetitionFound)->get();
        $CompetitionAjax = Competition::whereNotIn('id',$EventCompetitionFound)->get();
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
                if($Entry!=null)
                {
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
                if($food!=null)
                {
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
