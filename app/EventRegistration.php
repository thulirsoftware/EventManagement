<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
     protected $table    ='event_registered';
    protected $fillable =[	'user_id',
    						'event_id',
    						
    						];
}
