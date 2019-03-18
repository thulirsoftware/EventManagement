<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPurchase extends Model
{
    protected $table    ='purchased_tickets';
    protected $fillable =[	'name',
    						'email',
    						'memberType',
    						'tagDvId',
    						'eventId',
    						'eventName',
                            'eventName',
    						'totalAmount',
    						'paymentId',
    						];
}
