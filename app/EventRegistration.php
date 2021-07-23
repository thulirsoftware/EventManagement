<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
     protected $table    ='event_registration';
    protected $fillable =[	'user_id',
    						'event_id',
    						
    						];
}
