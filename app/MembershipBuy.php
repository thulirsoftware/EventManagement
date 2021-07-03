<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipBuy extends Model
{
     protected $table    ='membership_buy';
    protected $fillable =[	'user_id',
    						'membership_id',
    						'membership_code',
    						'membership_amount',
    						];
    					}
