<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function building()
    {
        return $this->belongsTo(Building::class)->withDefault();
    }

    function unit()
    {
        return $this->belongsTo(Unit::class)->withDefault();
    }

    function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }

    function guests()
    {
        return $this->hasMany(Guest::class);
    }

    function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
public function systemNotifications()
{
    return $this->hasMany(SystemNotification::class);
}


    public static function search($request)
    {
        $users = user::with(['building', 'unit', 'vehicle']) ->withCount('vehicle');

        // Filter by related User (Owner Name)
        if ($request->filled('name')) {
            $users->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->name}%"]);
        }

        if ($request->filled('email')) {
            $users->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $users->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('type')) {
            $users->where('type', 'like', '%' . $request->type . '%');
        }
        // Filter by related Category
        if ($request->filled('building')) {
            $users->whereHas('building', function ($q) use ($request) {
                $q->where('id', $request->building);
            });
        }

        if ($request->filled('unit')) {
            $users->whereHas('unit', function ($q) use ($request) {
                $q->where('id', $request->unit);
            });
        }

        if ($request->filled('user_number')) {
            $users->where('user_number', 'like', '%' . $request->user_number . '%');
        }

        if ($request->filled('verified')) {
            if ($request->verified == "Deactivated") {
                $users->where('email_verified_at', null);
            } else {
                $users->where('email_verified_at', '!=', null);
            }
        }
if ($request->filled('vehicles_count')) {
    $users->having('vehicle_count', '=', $request->vehicles_count);
}

        // Filter by Created At
        if ($request->filled('created_at')) {
            $users->where('created_at', 'like', '%' . $request->created_at . '%');
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $users = $users->onlyTrashed();
        }
        return $users;
    }





    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
