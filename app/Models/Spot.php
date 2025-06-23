<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    use HasFactory ,SoftDeletes;
protected $guarded = [];
   function building() {
    return $this->belongsTo(Building::class)->withDefault();
}

    function user() {
    return $this->belongsTo(user::class)->withDefault();
}

 public static function search($request)
    {
        $spots = Spot::with(['building']);

        // Filter by related Category


        if ($request->filled('name')) {
            $spots->where('name', 'like', '%' . $request->name . '%');
        }


        if ($request->filled('building')) {
            $spots->whereHas('building', function ($q) use ($request) {
                $q->where('id', $request->building);
            });
        }

              if ($request->filled('parking')) {
            $spots->whereHas('building.parking', function ($q) use ($request) {
                $q->where('id', $request->parking);
            });
        }

 if ($request->filled('type')) {
            $spots->where('type', 'like', '%' . $request->type . '%');
        }



        // Filter by related User (Owner Name)


        // Show trashed only if specified
        if ($request->page == 'trash') {
            $spots = $spots->onlyTrashed();
        }
        return $spots;
    }
}
