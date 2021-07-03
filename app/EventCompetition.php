<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCompetition extends Model
{
    protected $table    ='event_competition';
    protected $fillable =[  'event_id',
                            'competition_id',
                            ];
}
