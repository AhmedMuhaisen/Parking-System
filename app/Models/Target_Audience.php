<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Target_Audience extends Model
{
  use HasFactory ,SoftDeletes;
protected $guarded = [];
protected $table ='target_audiences';




 public static function search($request)
    {
        $users = User::query();

        if ($request->filled('user')) {
            $users->where('id', $request->user);
        }

        if ($request->filled('group')) {
            $users->where('type', $request->group);
        }

        return $users;
    }

}
