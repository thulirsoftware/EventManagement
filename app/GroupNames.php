<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupNames extends Model
{
     protected $guard = 'admin';
    protected $fillable = [
        'name', 'description', 'no_of_participants'
    ];
}
