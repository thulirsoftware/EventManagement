<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonMember extends Model
{
    protected $table    ='non_members';
    protected $fillable =[	'firstName',
    						'lastName',
    						'email',
    						'PhoneNo',
    						];
}
