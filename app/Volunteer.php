<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
     protected $table    ='volunteer';
    protected $fillable =[  'user_id',
                            'name',
                            'mobile_number',
                            'email',
                            'email_group',
                            'opportunities',
                            'comments',
                            'youth_volunteer',
                            'volunteer_for',
                            'event_id'
                            ];
}
