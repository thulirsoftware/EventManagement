<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table    ='entry_cfg';
    protected $fillable =[  'id',
                            'min_age',
                            'max_age',
                            'member_type',
                            'price',
                            ];
}
