<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
     protected $table    ='sponsorships';
    protected $fillable =[  
                            'user_id',
                            'sponsorship_id',
                            'payment_status',
                            'amount',
                            'sponsorship_for',
                            'event_id'
                            
                            ];
}
