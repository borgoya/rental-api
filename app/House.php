<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'house_no', 'house_type', 'house_location', 'description', 'img_link', 
        'owner_id'
    ];

  

}
