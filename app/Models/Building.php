<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
      use HasFactory, SoftDeletes;
    protected $guarded = [];

function parking() {
    return $this->belongsTo(Parking::class)->withDefault();
}

     function unit()
    {
        return $this->hasMany(Unit::class);
    }

       function spot()
    {
        return $this->hasMany(Spot::class);
    }
function users() {
    return $this->hasMany(User::class);
}
function user() {
    return $this->belongsTo(User::class)->withDefault();
}

    public static function search($request){

        $buildings = Building::with(['user','parking']);

    if ($request->filled('name')) {
        $buildings->where('name', 'like', '%' . $request->name . '%');
    }
    if ($request->filled('user')) {
        $buildings->whereHas('user', function ($q) use ($request) {
        $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->user}%"]);
    });}

         if ($request->filled('parking')) {
            $buildings->where('parking', 'like', '%' . $request->parking . '%');
        }

  if ($request->filled('max_units')) {
        $buildings->where('max_units', 'like', '%' . $request->max_units . '%');
    }

  if ($request->filled('max_users')) {
        $buildings->where('max_users', 'like', '%' . $request->max_users . '%');
    }
  if ($request->filled('max_vehicles')) {
        $buildings->where('max_vehicles', 'like', '%' . $request->max_vehicles . '%');
    }

  if ($request->filled('max_spots')) {
        $buildings->where('max_spots', 'like', '%' . $request->max_spots . '%');

  }

    if ($request->filled('max_guests')) {
        $buildings->where('max_guests', 'like', '%' . $request->max_guests . '%');
    }

    if ($request->page == 'trash') {
        $buildings = $buildings->onlyTrashed();
    }
    return $buildings;
    }




}
