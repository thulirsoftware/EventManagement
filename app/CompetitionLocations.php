<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionLocations extends Model
{
      protected $table    ='competition_locations';
    protected $fillable =[  'event_id',
                            'competition_id',
                            'location_id',
                            ];
}
