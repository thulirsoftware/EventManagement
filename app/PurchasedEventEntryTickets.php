<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedEventEntryTickets extends Model
{
    protected $table    ='purchased_event_entry_tickets';
    protected $fillable =[	'ticketId',
    						'eventId',
    						'userId',
    						'ticketQty',
    						'ticketAmount',
    						];
}
