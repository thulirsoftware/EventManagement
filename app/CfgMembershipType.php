<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CfgMembershipType extends Model
{
     protected $table    ='cfg_membership';
    protected $fillable =[  'cfg_membership',
                            'membership_code',
                            'membership_desc',
                            'membership_amount',
                            'is_visible',
                            'membership_type',
                            ];
}
