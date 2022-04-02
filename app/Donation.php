<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
     protected $table    ='donations';
    protected $fillable =[  'user_id',
                            'name',
                            'email',
                            'mobile_no',
                            'amount','address','city','pincode','comments','donation_for','campaign_id'
                            ];
}
