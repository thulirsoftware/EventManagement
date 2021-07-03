<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedEventFoodTickets extends Model
{
    protected $table    ='purchased_event_food_tickets';
    protected $fillable =[	'ticketId',
    						'eventId',
    						'userId',
    						'ticketQty',
    						'ticketAmount',
    						];
}
