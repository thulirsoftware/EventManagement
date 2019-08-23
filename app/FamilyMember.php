<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $table    ='family_members';
    protected $fillable =[	'tagDvId',
    						'firstName',
    						'lastName',
    						'relationshipType',
    						'phoneNo',
    						'dob',
    						'mob',
    						'schoolName',
    						];
}
