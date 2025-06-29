<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingWork extends Model
{

 use HasFactory, SoftDeletes;
    protected $guarded = [];




  public static function search($request){
        $parking_works = ParkingWork::query();

    if ($request->filled('title')) {
        $parking_works->where('title', 'like', '%' . $request->title . '%');
    }

        if ($request->filled('content')) {
        $parking_works->where('content', 'like', '%' . $request->content . '%');
    }

           if ($request->filled('step')) {
        $parking_works->where('step', 'like', '%' . $request->step . '%');
    }


    if ($request->filled('icon')) {
        $parking_works->where('icon', $request->icon);
    }


    if ($request->page == 'trash') {
        $parking_works = $parking_works->onlyTrashed();
    }
    return $parking_works;
    }
}
