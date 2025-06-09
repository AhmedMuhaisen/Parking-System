<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehiclesType extends Model
{
  use HasFactory, SoftDeletes;
    protected $guarded = [];


      public static function search($request){
  $vehiclesTypes = VehiclesType::withCount('vehicles'); // Add vehicle count for filtering

if ($request->filled('name')) {
    $vehiclesTypes->where('name', 'like', '%' . $request->name . '%');
}

if ($request->filled('vehicles_number')) {
    $vehiclesTypes->having('vehicles_count', '=', $request->vehicles_number);
}

if ($request->filled('created_at')) {
    $vehiclesTypes->whereDate('created_at', $request->created_at);
}

if ($request->page == 'trash') {
    $vehiclesTypes = $vehiclesTypes->onlyTrashed();
}

return $vehiclesTypes;
    }
          function vehicles()  {
        return $this->hasMany(Vehicle::class);
    }
}
