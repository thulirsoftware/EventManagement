<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $table    ='event_tickets';
    protected $fillable =[	'eventId',
    						'eventName',
    						'ageGroup',
    						'memberType',
    						'foodType',
    						'dateRange',
    						'ticketPrice',
    						];
}
