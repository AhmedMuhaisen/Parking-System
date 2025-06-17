<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VehiclesMovement extends Model
{

     use HasFactory, SoftDeletes;
       protected $guarded = [];

 function gate()  {
        return $this->belongsTo(Gate::class,'gate_id')->withDefault();
    }
  function vehicle()  {
        return $this->belongsTo(Vehicle::class);
    }


    public static function search($request){
     $vehicles = Vehicle::with(['gate', 'vehicle']);

    // Filter by related Category
   if ($request->filled('vehicle_number')) {
    $vehicles->whereHas('vehicle', function ($q) use ($request) {
        $q->where('vehicle_number', $request->vehicle_number);
    });
}

     if ($request->filled('gate')) {
    $vehicles->whereHas('gate', function ($q) use ($request) {
        $q->where('name', $request->gate);
    });
}

      if ($request->filled('vehicle_number')) {
        $vehicles->where('vehicle_number', 'like', '%' . $request->vehicle_number . '%');
    }

    if ($request->filled('category')) {
        $vehicles->whereHas('category', function ($q) use ($request) {
            $q->where('id',  $request->category );
        });
    }

    // Filter by related User (Owner Name)
 if ($request->filled('onr_name')) {
        $vehicles->whereHas('vehicle.user', function ($q) use ($request) {
        $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->onr_name}%"]);

    });
    }
   if ($request->filled('date')) {
        $vehicles->where('created_at', 'like', '%' . $request->date . '%');
    }

       if ($request->filled('time')) {
        $vehicles->where('created_at', 'like', '%' . $request->time . '%');
    }

    // Show trashed only if specified
    if ($request->page == 'trash') {
        $vehicles = $vehicles->onlyTrashed();
    }
    return $vehicles;
    }
}
