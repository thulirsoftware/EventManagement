<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipMandatory extends Model
{
    protected $table    ='membership_mandatories';
    protected $fillable =[  
                            'membership_id',
                            'name',
                            'status',
                            ];
}
