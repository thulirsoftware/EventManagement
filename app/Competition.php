<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
     protected $table    ='competition_cfg';
    protected $fillable =[  'name',
                            'member_fee',
                            'non_member_fee',
                            'awards',
                            'age_limit',
                            'competition_type',
                            'instruction',
                            ];
}
