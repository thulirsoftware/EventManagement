<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VipJudgeTickets extends Model
{
     protected $table    ='vip_judge_tickets';
    protected $fillable =[  'type',
                            'event_id',
                            'competition_id',
                            'start_time',
                            'end_time',
                            'no_entry_tickets',
                            'no_food_tickets',
                            'name'
                            ];
}
