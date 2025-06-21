<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
      use HasFactory, SoftDeletes;
    protected $guarded = [];



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






}
