<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonMember extends Model
{
    protected $table    ='non_members';
     protected $fillable =[ 'firstName',
                            'lastName',
                            'Email_Id',
                            'gender',
                            'dob',
                            'mob',
                            'maritalStatus',
                            'mobile_number',
                            'addressLine1',
                            'addressLine2',
                            'country',
                            'state',
                            'zipCode',
                            ];
}
