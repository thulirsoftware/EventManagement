<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table    ='events';
    protected $fillable =[	'eventName',
    						'eventDescription',
    						'eventFlyer',
    						'eventDate',
    						'eventTime',
    						'eventLocation',
    						'eventLocationLink',
    						];
}
