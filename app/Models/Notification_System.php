<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Notification_System extends Model
{
    use HasFactory,  SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];
    protected $table ='system_notifications';


    public static function search($request)
    {
        $notification_system = Notification_System::with(['building', 'unit', 'vehicle']) ->withCount('vehicle');


        // Filter by Created At
        if ($request->filled('created_at')) {
            $notification_system->where('created_at', 'like', '%' . $request->created_at . '%');
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $notification_system = $notification_system->onlyTrashed();
        }
        return $notification_system;
    }
}
