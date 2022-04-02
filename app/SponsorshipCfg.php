<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorshipCfg extends Model
{
     protected $table    ='sponsorship_cfgs';
    protected $fillable =[  
                            'name',
                            'amount',
                            'benefits','event_id','files'
                            
                            ];
}
