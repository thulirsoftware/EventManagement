<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodModel extends Model
{
    protected $table    ='food_cfg';
    protected $fillable =[  'id',
                            'food_type',
                            'price',
                            ];
}
