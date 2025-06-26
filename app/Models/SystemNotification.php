<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{

     protected $guarded = [];
   public function user()
{
    return $this->belongsTo(User::class);
}
   public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

}
