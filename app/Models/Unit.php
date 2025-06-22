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
}
