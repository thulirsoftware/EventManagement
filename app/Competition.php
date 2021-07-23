<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
     protected $table    ='cfg_competition';
    protected $fillable =[  'name',
                            'member_fee',
                            'non_member_fee',
                            'awards',
                            'age_limit',
                            'competition_type',
                            'instruction',
                            ];
}
