<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Master
{


    function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }


      function color()
    {
        return $this->belongsTo(Color::class)->withDefault();
    }
    function building()
    {
        return $this->belongsTo(Building::class, 'building_id')->withDefault();
    }
    function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id')->withDefault();
    }
    function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    function motor_type()
    {
        return $this->belongsTo(MotorType::class, 'motor_type_id')->withDefault();
    }

    function vehicle_type()
    {
        return $this->belongsTo(VehiclesType::class, 'vehicles_type_id')->withDefault();
    }
    function vehicle_brand()
    {
        return $this->belongsTo(VehiclesBrand::class, 'vehicles_brand_id')->withDefault();
    }

    public static function search($request)
    {
        $vehicles = Vehicle::with(['category','color', 'motor_type', 'vehicle_type', 'vehicle_brand', 'user']);

        // Filter by related Category

        if ($request->filled('color')) {
            $vehicles->whereHas('color', function ($q) use ($request) {
                $q->where('id', $request->color);
            });
        }
        if ($request->filled('building')) {
            $vehicles->whereHas('user.building', function ($q) use ($request) {
                $q->where('id', $request->building);
            });
        }

        if ($request->filled('unit')) {
            $vehicles->whereHas('user.unit', function ($q) use ($request) {
                $q->where('id', $request->unit);
            });
        }

        if ($request->filled('vehicle_number')) {
            $vehicles->where('vehicle_number', 'like', '%' . $request->vehicle_number . '%');
        }

        if ($request->filled('category')) {
            $vehicles->whereHas('category', function ($q) use ($request) {
                $q->where('id',  $request->category);
            });
        }

        // Filter by related Motor type
        if ($request->filled('motor_type')) {
            $vehicles->whereHas('motor_type', function ($q) use ($request) {
                $q->where('id', $request->motor_type);
            });
        }

        // Filter by related Vehicle Type
        if ($request->filled('vehicle_type')) {
            $vehicles->whereHas('vehicle_type', function ($q) use ($request) {
                $q->where('id', $request->vehicle_type);
            });
        }

        // Filter by related Brand
        if ($request->filled('vehicle_brand')) {
            $vehicles->whereHas('vehicle_brand', function ($q) use ($request) {
                $q->where('id', $request->vehicle_brand);
            });
        }

        // Filter by related User (Owner Name)
        if ($request->filled('onr_name')) {
            $vehicles->whereHas('user', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->onr_name}%"]);
            });
        }
      if ($request->filled('date_start')) {
            $vehicles->where('date_start', '>=', $request->date_end);
        }

        if ($request->filled('date_end')) {
            $vehicles->where('date_End', '<=', $request->date_end);
        }

        // Filter by Created At
        if ($request->filled('created_at')) {
            $vehicles->where('created_at', '>=', $request->created_at);
        }

        // Show trashed only if specified
        if ($request->page == 'trash') {
            $vehicles = $vehicles->onlyTrashed();
        }
        return $vehicles;
    }
}
