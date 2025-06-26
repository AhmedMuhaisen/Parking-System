<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class notificationChannel extends Model
{
    use HasFactory,SoftDeletes;
 protected $guarded = [];
     public function notification() {
        return $this->belongsTo(Notification::class);
    }
}
