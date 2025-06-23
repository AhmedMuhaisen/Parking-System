<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory, SoftDeletes;
    protected $guarded = [];


    public static function search($request){
         $categories=Category::select('id', 'name', 'work_method', 'status', 'created_at');
        $categories = Category::query();

    if ($request->filled('name')) {
        $categories->where('name', 'like', '%' . $request->name . '%');
    }

        if ($request->filled('description')) {
        $categories->where('description', 'like', '%' . $request->description . '%');
    }

    if ($request->filled('status')) {
        $categories->where('status', $request->status);
    }

    if ($request->filled('work_method')) {
        $categories->where('work_method', $request->work_method);
    }

    if ($request->filled('created_at')) {
        $categories->whereDate('created_at','like', '%' . $request->created_at . '%');
    }

    if ($request->page == 'trash') {
        $categories = $categories->onlyTrashed();
    }
    return $categories;
    }
}
