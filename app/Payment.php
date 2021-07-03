<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table    ='payments';
    protected $fillable =[	'Member_Id',
    						'name',
    						'email',
    						'paypalEmail',
    						'transactionId',
    						'purpose',
    						'amount',
    						'amountType',
    						'status',
    						'paymentDate',
    					];
}
