<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
       protected $guarded = [];


    function motor_type()  {
        return $this->belongsTo(MotorType::class)->withDefault();
    }

     function vehicle_type()  {
        return $this->belongsTo(VehiclesType::class)->withDefault();
    }
  function car_type()  {
        return $this->belongsTo(CarsType::class)->withDefault();
    }
}
