<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
   protected $guarded = [];

           function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }


 public static function search($request)
    {
        $testimonial = Testimonial::with(['user']);

        // Filter by related Category


        if ($request->filled('rating')) {
            $testimonial->where('rating', 'like', '%' . $request->rating . '%');
        }

        if ($request->filled('text')) {
            $testimonial->where('text', 'like', '%' . $request->text . '%');
        }

      if ($request->filled('created_at')) {
            $testimonial->where('created_at', 'like', '%' . $request->created_at . '%');
        }


        // Filter by related User (Owner Name)
        if ($request->filled('user')) {
            $testimonial->whereHas('user', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->user}%"]);
            });
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $testimonial = $testimonial->onlyTrashed();
        }
        return $testimonial;
    }

}
