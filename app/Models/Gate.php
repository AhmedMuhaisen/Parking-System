<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gate extends Model
{
      use HasFactory, SoftDeletes;
    protected $guarded = [];

    function parking() {
    return $this->belongsTo(Parking::class)->withDefault();
}

    public static function search($request){
         $gates=Gate::with(['parking']);
        $gates = Gate::query();

    if ($request->filled('name')) {
        $gates->where('name', 'like', '%' . $request->name . '%');
    }

        if ($request->filled('address')) {
        $gates->where('address', 'like', '%' . $request->address . '%');
    }

    if ($request->filled('status')) {
        $gates->where('status', $request->status);
    }

     if ($request->filled('type')) {
        $gates->where('type', $request->type);
    }


         if ($request->filled('parking')) {
            $gates->where('parking', 'like', '%' . $request->parking . '%');
        }

    if ($request->filled('open_method')) {
        $gates->where('open_method', $request->open_method);
    }

    if ($request->filled('created_at')) {
        $gates->whereDate('created_at','like', '%' . $request->created_at . '%');
    }

    if ($request->page == 'trash') {
        $gates = $gates->onlyTrashed();
    }
    return $gates;
    }
}
