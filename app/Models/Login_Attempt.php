<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Login_Attempt extends Model
{
         use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table='login_attempts';
    function gate() {
    return $this->belongsTo(Gate::class)->withDefault();
}


 public static function search($request)
    {
        $login_attempts = Login_Attempt::with(['gate']);

        // Filter by related Category


        if ($request->filled('name')) {
            $login_attempts->where('name', 'like', '%' . $request->name . '%');
        }


        if ($request->filled('gate')) {
            $login_attempts->whereHas('gate', function ($q) use ($request) {
                $q->where('id', $request->gate);
            });
        }

              if ($request->filled('parking')) {
            $login_attempts->whereHas('gate.parking', function ($q) use ($request) {
                $q->where('id', $request->parking);
            });
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $login_attempts = $login_attempts->onlyTrashed();
        }
        return $login_attempts;
    }

}
