<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
     protected $guard = 'admin';
    protected $fillable = [
        'name', 'description', 'goal', 'start_date', 'end_date'
    ];
}
