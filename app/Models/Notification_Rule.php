<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Notification_Rule extends Model
{
    use HasFactory,  SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];
    protected $table ='notification_rules';
// function building()
//     {
//         return $this->belongsTo(Building::class)->withDefault();
//     }

//     function unit()
//     {
//         return $this->belongsTo(Unit::class)->withDefault();
//     }

//     function role()
//     {
//         return $this->belongsTo(Role::class)->withDefault();
//     }

//     function vehicle()
//     {
//         return $this->hasMany(Vehicle::class);
//     }

//     function guests()
//     {
//         return $this->hasMany(Guest::class);
//     }

    function target_audience()
    {
        return $this->belongsTo(Target_Audience::class)->withDefault();
    }

    public static function search($request)
    {
        $notification_rule = Notification_Rule::with(['building', 'unit', 'vehicle']) ->withCount('vehicle');

        // Filter by related User (Owner Name)
        if ($request->filled('name')) {
            $notification_rule->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->name}%"]);
        }

        if ($request->filled('email')) {
            $notification_rule->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $notification_rule->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('type')) {
            $notification_rule->where('type', 'like', '%' . $request->type . '%');
        }
        // Filter by related Category
        if ($request->filled('building')) {
            $notification_rule->whereHas('building', function ($q) use ($request) {
                $q->where('id', $request->building);
            });
        }

        if ($request->filled('unit')) {
            $notification_rule->whereHas('unit', function ($q) use ($request) {
                $q->where('id', $request->unit);
            });
        }

        if ($request->filled('user_number')) {
            $notification_rule->where('user_number', 'like', '%' . $request->user_number . '%');
        }

        if ($request->filled('verified')) {
            if ($request->verified == "Deactivated") {
                $notification_rule->where('email_verified_at', null);
            } else {
                $notification_rule->where('email_verified_at', '!=', null);
            }
        }
if ($request->filled('vehicles_count')) {
    $notification_rule->having('vehicle_count', '=', $request->vehicles_count);
}

        // Filter by Created At
        if ($request->filled('created_at')) {
            $notification_rule->where('created_at', 'like', '%' . $request->created_at . '%');
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $notification_rule = $notification_rule->onlyTrashed();
        }
        return $notification_rule;
    }
}
