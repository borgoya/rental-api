<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'reg_no', 'vehicle_type', 'model', 'brand', 'fuel_type', 
        'rent_price','mfd', 'booking_status', 'description', 'img_link', 
        'owner_id'
    ];

   

}
