<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VipJudgeTickets;
use App\EventCompetition;
use App\EventEntryTickets;
use App\EventFoodTickets;
use App\Competition;

class VipJudgeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function addVipTicket($eventId)
    {
        $eventCompetition = EventCompetition::where('event_id',$eventId)->pluck('competition_id');
        $competitions = Competition::whereIn('id',$eventCompetition)->get();

        return view('admin.event.vip_ticket_add',compact('eventId','competitions'));
    }

    public function createVipTicket(Request $request)
    {
        $VipJudgeTickets = VipJudgeTickets::create($request->all());  
        return redirect(url('admin/eventTickets/'.$request->event_id))->withInput(["tab" =>"nav-vip"])->withSuccess('Food Ticket Added Successfully');
    }
}
