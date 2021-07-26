<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $table    ='event_food_tickets';
    protected $fillable =[	'eventId',
    						'ageGroup',
    						'memberType',
    						'foodType',
    						'ticketPrice',
    						];

    
}
