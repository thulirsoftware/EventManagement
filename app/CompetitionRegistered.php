<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionRegistered extends Model
{
     protected $table    ='competition_registration';
    protected $fillable =[  'event_id',
                            'competition_id',
                            'participant_id',
                            ];
}
