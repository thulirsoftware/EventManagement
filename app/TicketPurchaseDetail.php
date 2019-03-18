<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPurchaseDetail extends Model
{
    protected $table    ='purchased_ticket_details';
    protected $fillable =[	'ticketId',
    						'ticketType',
    						'ticketQty',
    						'ticketAmount',
    						];
}
