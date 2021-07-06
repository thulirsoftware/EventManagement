<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionRegistered extends Model
{
     protected $table    ='competition_registered_users';
    protected $fillable =[  'event_id',
                            'competition_id',
                            'participant_id',
                            ];
}
