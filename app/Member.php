<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table    ='members';
    protected $fillable =[	'firstName',
    						'lastName',
    						'primaryEmail',
    						'secondaryEmail',
    						'Member_Id',
    						'gender',
    						'dob',
                            'mob',
    						'maritalStatus',
    						'phoneNo1',
    						'phoneNo2',
    						'addressLine1',
    						'addressLine2',
    						'country',
    						'state',
    						'zipCode',
    						'membershipType',
    						'membershipExpiryDate',
    						];
}
