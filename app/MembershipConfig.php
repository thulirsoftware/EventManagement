<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipConfig extends Model
{
    protected $table    ='cfg_membership';
    protected $fillable =[	'membership_code',
    						'membership_desc',
    						'membership_amount',
    						'is_visible',
    						'starting_date',
    						'closing_date',
    						];
}
