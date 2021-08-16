<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchasedEventEntryTickets;
use App\PurchasedEventFoodTickets;
use App\Event;
use App\Volunteer;
use App\User;
use View;
use Response;
use DB;
use App\EventTicket;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function FoodTicketsReport()
    {
        $PurchasedEventFoodTickets = PurchasedEventFoodTickets::get();
        $events = Event::get();
        $event_date = Event::get();
        $purchased_user_tickets = PurchasedEventFoodTickets::where('ticketQty','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();
        return view('admin.reports.food_tickets_reports',compact('PurchasedEventFoodTickets','events','event_date','purchased_users'));
    }

    public function FoodTicketsReportFilter(Request $request)
    {
        $PurchasedEventFoodTickets = PurchasedEventFoodTickets::where('ticketAmount','!=',null);
        $events = Event::get();
        $event_date = Event::get();
        $purchased_user_tickets = PurchasedEventFoodTickets::where('ticketAmount','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();
        if($request->event_name!=null)
        {
            $PurchasedEventFoodTickets= $PurchasedEventFoodTickets->where('eventId',$request->event_name)->groupBy('ticketId'); 
        }
        if($request->event_date!=null)
        {
             
            $PurchasedEventFoodTickets= $PurchasedEventFoodTickets->where('eventId',$request->event_date)->groupBy('ticketId'); 
        }
        if($request->user_id!=null)
        {
             
            $PurchasedEventFoodTickets= $PurchasedEventFoodTickets->where('userId',$request->user_id)->groupBy('ticketId'); 
        }
        if($request->food_type!=null)
        {
            $EventTicket = EventTicket::where('foodType',$request->food_type)->pluck('id');

            $PurchasedEventFoodTickets= $PurchasedEventFoodTickets->whereIn('ticketId',$EventTicket)->groupBy('ticketId'); 
        }
        $PurchasedEventFoodTickets = $PurchasedEventFoodTickets->get(array(DB::raw('COUNT(userId) as no_of_tickets'),'eventId','userId','ticketAmount','ticketId'));;

        $FoodTickets = View::make('admin.reports.food_tickets_reports_filter',compact('PurchasedEventFoodTickets','events','event_date','purchased_users'))->render();

        return Response::json(['FoodTickets' => $FoodTickets]);

    }

    public function EntryTicketsReport()
    {
        $PurchasedEventEntryTickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->get();
        $events = Event::get();
        $event_date = Event::get();
        $purchased_user_tickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();

        return view('admin.reports.entry_tickets_reports',compact('PurchasedEventEntryTickets','events','event_date','purchased_users'));
    }

    public function EntryTicketsReportFilter(Request $request)
    {
        $PurchasedEventEntryTickets = PurchasedEventEntryTickets::where('ticketQty','!=',null); 
        $events = Event::get();
        $event_date = Event::get();
        $purchased_user_tickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();
        if($request->event_name!=null)
        {
            $PurchasedEventEntryTickets= $PurchasedEventEntryTickets->where('eventId',$request->event_name)->groupBy('userId'); 
        }
        if($request->event_date!=null)
        {
             
            $PurchasedEventEntryTickets= $PurchasedEventEntryTickets->where('eventId',$request->event_date)->groupBy('userId'); 
        }
        if($request->user_id!=null)
        {
             
            $PurchasedEventEntryTickets= $PurchasedEventEntryTickets->where('userId',$request->user_id)->groupBy('userId'); 
        }
        $PurchasedEventEntryTickets = $PurchasedEventEntryTickets->get(array(DB::raw('COUNT(userId) as no_of_tickets'),'eventId','userId','ticketAmount'));;

        $EntryTickets = View::make('admin.reports.entry_tickets_reports_filter',compact('PurchasedEventEntryTickets','events','event_date','purchased_users'))->render();

        return Response::json(['EntryTickets' => $EntryTickets]);

    }

    public function VolunteerReports()
    {
        $Volunteers = Volunteer::get();
        return view('admin.volunteer_reports',compact('Volunteers'));
    }

}
