<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
     use HasFactory, SoftDeletes;
    protected $guarded = [];

 public static function search($request)
    {
        $message = Message::query();

        // Filter by related Category


        if ($request->filled('email')) {
            $message->where('email', 'like', '%' . $request->email . '%');
        }
     if ($request->filled('subject')) {
            $message->where('subject', 'like', '%' . $request->subject . '%');
        }
            if ($request->filled('message')) {
            $message->where('message', 'like', '%' . $request->message . '%');
        }
           if ($request->filled('created_at')) {
            $message->where('created_at', 'like', '%' . $request->created_at . '%');
        }



        // Show trashed only if specified
        if ($request->page == 'trash') {
            $message = $message->onlyTrashed();
        }
        return $message;
    }

}
