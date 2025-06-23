<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{    use HasFactory ,SoftDeletes;
protected $guarded = [];
    function building() {
    return $this->belongsTo(Building::class)->withDefault();
}

    function user() {
    return $this->belongsTo(user::class)->withDefault();
}

 public static function search($request)
    {
        $units = Unit::with(['user', 'building']);

        // Filter by related Category


        if ($request->filled('name')) {
            $units->where('name', 'like', '%' . $request->name . '%');
        }


        if ($request->filled('building')) {
            $units->whereHas('building', function ($q) use ($request) {
                $q->where('id', $request->building);
            });
        }

              if ($request->filled('parking')) {
            $units->whereHas('building.parking', function ($q) use ($request) {
                $q->where('id', $request->parking);
            });
        }

        // Filter by related User (Owner Name)
        if ($request->filled('onr_name')) {
            $units->whereHas('user', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->onr_name}%"]);
            });
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $units = $units->onlyTrashed();
        }
        return $units;
    }
}
