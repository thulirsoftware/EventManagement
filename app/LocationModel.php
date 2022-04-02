<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationModel extends Model
{
    protected $table    ='location_cfg';
    protected $fillable =[  'id',
                            'location_name',
                            'duration_from',
                            'duration_to',
                            'status',
                            'location_for'
                            ];
                        
}
