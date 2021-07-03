<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventEntryTickets extends Model
{
     protected $table    ='event_entry_tickets';
    protected $fillable =[	'eventId',
    						'ageGroup',
    						'memberType',
    						'ticketPrice',
    						];
}
