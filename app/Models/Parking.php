<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{

       use HasFactory, SoftDeletes;
    protected $guarded = [];


     function buildings()
    {
        return $this->hasMany(Building::class);
    }

function user() {
    return $this->belongsTo(User::class)->withDefault();
}

    function gate()
    {
        return $this->hasMany(Gate::class);
    }

     function camera()
    {
        return $this->hasMany(Camera::class);
    }







    public static function search($request){

        $parkings = Parking::with(['user']);

    if ($request->filled('name')) {
        $parkings->where('name', 'like', '%' . $request->name . '%');
    }
    if ($request->filled('user')) {
        $parkings->whereHas('user', function ($q) use ($request) {
        $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->user}%"]);
    });}
    if ($request->filled('max_buildings')) {
        $parkings->where('max_buildings', 'like', '%' . $request->max_buildings . '%');
    }
  if ($request->filled('max_units')) {
        $parkings->where('max_units', 'like', '%' . $request->max_units . '%');
    }
  if ($request->filled('max_gates')) {
        $parkings->where('max_gates', 'like', '%' . $request->max_gates . '%');
    }
  if ($request->filled('max_users')) {
        $parkings->where('max_users', 'like', '%' . $request->max_users . '%');
    }
  if ($request->filled('max_vehicles')) {
        $parkings->where('max_vehicles', 'like', '%' . $request->max_vehicles . '%');
    }
  if ($request->filled('max_cameras')) {
        $parkings->where('max_cameras', 'like', '%' . $request->max_cameras . '%');
    }
  if ($request->filled('max_spots')) {
        $parkings->where('max_spots', 'like', '%' . $request->max_spots . '%');

  }

    if ($request->filled('max_guests')) {
        $parkings->where('max_guests', 'like', '%' . $request->max_guests . '%');
    }

    if ($request->page == 'trash') {
        $parkings = $parkings->onlyTrashed();
    }
    return $parkings;
    }
}
