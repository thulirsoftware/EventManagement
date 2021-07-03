<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $table    ='family_members';
    protected $fillable =[	'Member_Id',
    						'firstName',
    						'lastName',
    						'relationshipType',
    						'phoneNo',
    						'dob',
    						'mob',
    						'schoolName',
    						];
}
