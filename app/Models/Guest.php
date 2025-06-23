<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Guest extends Model
{ use HasFactory, SoftDeletes;
      protected $guarded = [];

       function user() {
    return $this->belongsTo(user::class)->withDefault();
}


    public static function search($request)
    {
        $guests = Guest::with(['user']);

        // Filter by related Category


        if ($request->filled('name')) {
            $guests->where('name', 'like', '%' . $request->name . '%');
        }


          if ($request->filled('type')) {
            $guests->where('type', 'like', '%' . $request->type . '%');
        }
        // Filter by related User (Owner Name)
        if ($request->filled('user')) {
            $guests->whereHas('user', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->user}%"]);
            });
        }

            if ($request->filled('vehicle_number')) {
            $guests->where('vehicle_number', 'like', '%' . $request->vehicle_number . '%');
        }

      if ($request->filled('login_date')) {
            $guests->where('login_date', '>=', $request->login_date);
        }

      if ($request->filled('login_time')) {
            $guests->where('login_time', '>=', $request->login_time);
        }

      if ($request->filled('logout_time')) {
            $guests->where('logout_time', '<=', $request->logout_time);
        }

        if ($request->filled('logout_date')) {
            $guests->where('logout_date', '<=', $request->logout_date);
        }

      if ($request->filled('time_remaining')) {
            $guests->where('time_remaining', 'like', '%' . $request->time_remaining . '%');
        }

             if ($request->filled('number_visits')) {
            $guests->where('number_visits', 'like', '%' . $request->number_visits . '%');
        }
             if ($request->filled('notes')) {
            $guests->where('notes', 'like', '%' . $request->notes . '%');
        }


        // Show trashed only if specified
        if ($request->page == 'trash') {
            $guests = $guests->onlyTrashed();
        }
        return $guests;
    }




}
