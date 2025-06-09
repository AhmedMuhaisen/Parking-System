<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehiclesBrand extends Model
{
   use HasFactory, SoftDeletes;
    protected $guarded = [];


      public static function search($request){
       $vehiclesBrands = VehiclesBrand::withCount('vehicles');

    if ($request->filled('name')) {
        $vehiclesBrands->where('name', 'like', '%' . $request->name . '%');
    }
if ($request->filled('vehicles_number')) {
    $vehiclesBrands->having('vehicles_count', '=', $request->vehicles_number);
}
    if ($request->filled('created_at')) {
        $vehiclesBrands->whereDate('created_at','like', '%' . $request->created_at . '%');
    }

    if ($request->page == 'trash') {
        $vehiclesBrands = $vehiclesBrands->onlyTrashed();
    }
    return $vehiclesBrands;
    }

        function vehicles()  {
        return $this->hasMany(Vehicle::class);
    }
}
