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
         $vehiclesBrands=VehiclesBrand::select('id', 'name','created_at');
        $vehiclesBrands = VehiclesBrand::query();

    if ($request->filled('name')) {
        $vehiclesBrands->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('created_at')) {
        $vehiclesBrands->whereDate('created_at', $request->created_at);
    }

    if ($request->page == 'trash') {
        $vehiclesBrands = $vehiclesBrands->onlyTrashed();
    }
    return $vehiclesBrands;
    }
}
