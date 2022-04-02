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
use App\Donation;
use App\Sponsorship;
use App\EventCompetition;
use App\Competition;
use App\CompetitionRegistered;
use App\TicketPurchase;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function FoodTicketsReport()
    {
         $paymentStatus = TicketPurchase::where('paymentStatus','approved')->pluck('eventId');
        $PurchasedEventFoodTickets = PurchasedEventFoodTickets::whereIn('eventId',$paymentStatus)->get();
       
        $events = Event::get();
        $event_date = Event::get();
        $purchased_user_tickets = PurchasedEventFoodTickets::where('ticketQty','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();
        return view('admin.reports.food_tickets_reports',compact('PurchasedEventFoodTickets','events','event_date','purchased_users'));
    }

    public function FoodTicketsReportFilter(Request $request)
    {
        $paymentStatus = TicketPurchase::where('paymentStatus','approved')->pluck('eventId');
        $PurchasedEventFoodTickets = PurchasedEventFoodTickets::where('ticketAmount','!=',null)->whereIn('eventId',$paymentStatus);
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
        $paymentStatus = TicketPurchase::where('paymentStatus','approved')->pluck('eventId');
        
        $PurchasedEventEntryTickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->whereIn('eventId',$paymentStatus)->get();
        $events = Event::get();
        $event_date = Event::get();
        $purchased_user_tickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();

         $eventCompetitions = EventCompetition::get();
         $Competitions = Competition::get();


        return view('admin.reports.entry_tickets_reports',compact('PurchasedEventEntryTickets','events','event_date','purchased_users','eventCompetitions','Competitions'));
    }

    public function EntryTicketsReportFilter(Request $request)
    {
        $paymentStatus = TicketPurchase::where('paymentStatus','approved')->pluck('eventId');
        
        $PurchasedEventEntryTickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->whereIn('eventId',$paymentStatus); 
        $events = Event::get();
        $purchased_user_tickets = PurchasedEventEntryTickets::where('ticketQty','!=',null)->pluck('userId');
         $purchased_users = User::whereIn('id',$purchased_user_tickets)->get();
        if($request->event_name!=null)
        {
            $PurchasedEventEntryTickets= $PurchasedEventEntryTickets->where('eventId',$request->event_name)->groupBy('userId'); 
        }
        if($request->competition_id!=null)
        {
            $competitions = CompetitionRegistered::where('competition_id',$request->competition_id)->pluck('event_id');
             
            $PurchasedEventEntryTickets= $PurchasedEventEntryTickets->whereIn('eventId',$competitions)->groupBy('userId'); 
        }
        if($request->user_id!=null)
        {
             
            $PurchasedEventEntryTickets= $PurchasedEventEntryTickets->where('userId',$request->user_id)->groupBy('userId'); 
        }
        $PurchasedEventEntryTickets = $PurchasedEventEntryTickets->get(array(DB::raw('COUNT(userId) as no_of_tickets'),'eventId','userId','ticketAmount'));;

        $EntryTickets = View::make('admin.reports.entry_tickets_reports_filter',compact('PurchasedEventEntryTickets','events','purchased_users'))->render();

        return Response::json(['EntryTickets' => $EntryTickets]);

    }

    public function VolunteerReports()
    {
        $Volunteers = Volunteer::get();
        return view('admin.reports.volunteer_reports',compact('Volunteers'));
    }
    
    public function VolunteerReportsFilter(Request $request)
    {
        $Volunteers =Volunteer::orderby('id','desc'); 
        if($request->volunteer_for!=null)
        {
            $Volunteers = $Volunteers->where('volunteer_for',$request->volunteer_for); 
            
        }
        if($request->volunteer_for!='G' && $request->event_id!=null)
        {
            $Volunteers = $Volunteers->where('event_id',$request->event_id); 
            
        }
        $Volunteers = $Volunteers->get();
        $Volunteers = View::make('admin.reports.volunteer_reports_filter',compact('Volunteers'))->render();
        return Response::json(['Volunteers' => $Volunteers]);
    }

    public function DonationsReport()
    {
        $Donation = Donation::get();
        return view('admin.reports.donation_reports',compact('Donation'));
    }
    
     public function donationsReportsFilter(Request $request)
    {
        $Donation = Donation::orderby('id','desc');
        if($request->donation_for!=null)
        {
            $Donation = $Donation->where('donation_for',$request->donation_for); 
            
        }
        if($request->donation_for!='C' && $request->campaign_id!=null)
        {
            $Donation = $Donation->where('campaign_id',$request->campaign_id); 
            
        }
        if($request->donation_for=='C' && $request->campaign_id==null)
        {
            $Donation = $Donation->where('campaign_id',$request->campaign_id); 
            
        }
        $Donation = $Donation->get();
        $Donation = View::make('admin.reports.donation_reports_filter',compact('Donation'))->render();
        return Response::json(['Donation' => $Donation]);
    }

    public function SponsorsReport()
    {
        $Sponsorship = Sponsorship::get();
        return view('admin.reports.sponsors_reports',compact('Sponsorship'));
    }
    
    public function sponsorsReportsFilter(Request $request)
    {
         $Sponsorship =Sponsorship::orderby('id','desc'); 
        if($request->sponsorship_for!=null)
        {
            $Sponsorship = $Sponsorship->where('sponsorship_for',$request->sponsorship_for); 
            
        }
        if($request->sponsorship_for!='G' && $request->event_id!=null)
        {
            $Sponsorship = $Sponsorship->where('event_id',$request->event_id); 
            
        }
        if($request->sponsorship_for=='E' && $request->event_id==null)
        {
            $Sponsorship = $Sponsorship->where('event_id',$request->event_id); 
            
        }
        $Sponsorship = $Sponsorship->get();
        $Sponsorship = View::make('admin.reports.sponsors_reports_filter',compact('Sponsorship'))->render();
        return Response::json(['Sponsorships' => $Sponsorship]);
    }
    
    public function CompetitionReport()
    {
        $paymentStatus = TicketPurchase::where('paymentStatus','approved')->pluck('eventId');
        $competitions = CompetitionRegistered::orderby('id','desc')->where('fees','!=',null)->whereIn('event_id',$paymentStatus)->get();
        $eventcompetitionCfg = EventCompetition::orderby('id','desc')->get();
         $competitionCfg = Competition::orderby('id','desc')->get();
        $events = Event::get();
        return view('admin.reports.competition_reports',compact('competitions','competitionCfg','events','eventcompetitionCfg'));
    }
    
    public function CompetitionReportFilter(Request $request)
    {   
        $paymentStatus = TicketPurchase::where('paymentStatus','approved')->pluck('eventId');
         $competitions =CompetitionRegistered::orderby('id','desc')->where('fees','!=',null)->whereIn('event_id',$paymentStatus); 
         if($request->event_id!=null)
        {
            $competitions = $competitions->where('event_id',$request->event_id); 
            
        }
        if($request->competition_id!=null)
        {
            $competitions = $competitions->where('competition_id',$request->competition_id); 

        }
        $competitions = $competitions->get();
        $competitions = View::make('admin.reports.competition_reports_filter',compact('competitions'))->render();
        return Response::json(['competitions' => $competitions]);
    }

}
