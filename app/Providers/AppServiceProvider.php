<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Gate::define('category.index', function ($user) {
            return (in_array('category.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('category.create', function ($user) {
            return (in_array('category.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('category.update', function ($user) {
            return (in_array('category.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('category.delete', function ($user) {
            return (in_array('category.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('category.restore', function ($user) {
            return (in_array('category.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('category.forceDelete', function ($user) {
            return (in_array('category.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });




          Gate::define('vehiclesType.index', function ($user) {
            return (in_array('vehiclesType.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesType.create', function ($user) {
            return (in_array('vehiclesType.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesType.update', function ($user) {
            return (in_array('vehiclesType.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesType.delete', function ($user) {
            return (in_array('vehiclesType.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesType.restore', function ($user) {
            return (in_array('vehiclesType.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesType.forceDelete', function ($user) {
            return (in_array('vehiclesType.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });



             Gate::define('vehiclesBrand.index', function ($user) {
            return (in_array('vehiclesBrand.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesBrand.create', function ($user) {
            return (in_array('vehiclesBrand.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesBrand.update', function ($user) {
            return (in_array('vehiclesBrand.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesBrand.delete', function ($user) {
            return (in_array('vehiclesBrand.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesBrand.restore', function ($user) {
            return (in_array('vehiclesBrand.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesBrand.forceDelete', function ($user) {
            return (in_array('vehiclesBrand.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

         Gate::define('vehicle.index', function ($user) {
            return (in_array('vehicle.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehicle.create', function ($user) {
            return (in_array('vehicle.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehicle.update', function ($user) {
            return (in_array('vehicle.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehicle.delete', function ($user) {
            return (in_array('vehicle.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehicle.restore', function ($user) {
            return (in_array('vehicle.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehicle.forceDelete', function ($user) {
            return (in_array('vehicle.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


                     Gate::define('vehiclesMovement.index', function ($user) {
            return (in_array('vehiclesMovement.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesMovement.create', function ($user) {
            return (in_array('vehiclesMovement.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesMovement.update', function ($user) {
            return (in_array('vehiclesMovement.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesMovement.delete', function ($user) {
            return (in_array('vehiclesMovement.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesMovement.restore', function ($user) {
            return (in_array('vehiclesMovement.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('vehiclesMovement.forceDelete', function ($user) {
            return (in_array('vehiclesMovement.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


             Gate::define('user.index', function ($user) {
            return (in_array('user.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('user.create', function ($user) {
            return (in_array('user.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('user.update', function ($user) {
            return (in_array('user.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('user.delete', function ($user) {
            return (in_array('user.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('user.restore', function ($user) {
            return (in_array('user.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('user.forceDelete', function ($user) {
            return (in_array('user.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


   Gate::define('parking.index', function ($user) {
            return (in_array('parking.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('parking.create', function ($user) {
            return (in_array('parking.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('parking.update', function ($user) {
            return (in_array('parking.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('parking.delete', function ($user) {
            return (in_array('parking.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('parking.restore', function ($user) {
            return (in_array('parking.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('parking.forceDelete', function ($user) {
            return (in_array('parking.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });



   Gate::define('building.index', function ($user) {
            return (in_array('building.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('building.create', function ($user) {
            return (in_array('building.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('building.update', function ($user) {
            return (in_array('building.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('building.delete', function ($user) {
            return (in_array('building.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('building.restore', function ($user) {
            return (in_array('building.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('building.forceDelete', function ($user) {
            return (in_array('building.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


 Gate::define('unit.index', function ($user) {
            return (in_array('unit.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('unit.create', function ($user) {
            return (in_array('unit.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('unit.update', function ($user) {
            return (in_array('unit.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('unit.delete', function ($user) {
            return (in_array('unit.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('unit.restore', function ($user) {
            return (in_array('unit.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('unit.forceDelete', function ($user) {
            return (in_array('unit.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

 Gate::define('gate.index', function ($user) {
            return (in_array('gate.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('gate.create', function ($user) {
            return (in_array('gate.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('gate.update', function ($user) {
            return (in_array('gate.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('gate.delete', function ($user) {
            return (in_array('gate.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('gate.restore', function ($user) {
            return (in_array('gate.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('gate.forceDelete', function ($user) {
            return (in_array('gate.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

 Gate::define('spot.index', function ($user) {
            return (in_array('spot.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('spot.create', function ($user) {
            return (in_array('spot.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('spot.update', function ($user) {
            return (in_array('spot.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('spot.delete', function ($user) {
            return (in_array('spot.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('spot.restore', function ($user) {
            return (in_array('spot.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('spot.forceDelete', function ($user) {
            return (in_array('spot.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


         Gate::define('guest.index', function ($user) {
            return (in_array('guest.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('guest.create', function ($user) {
            return (in_array('guest.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('guest.update', function ($user) {
            return (in_array('guest.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('guest.delete', function ($user) {
            return (in_array('guest.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('guest.restore', function ($user) {
            return (in_array('guest.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('guest.forceDelete', function ($user) {
            return (in_array('guest.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


 Gate::define('register_request.index', function ($user) {
            return (in_array('register_request.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('register_request.create', function ($user) {
            return (in_array('register_request.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('register_request.accept', function ($user) {
            return (in_array('register_request.accept', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('register_request.delete', function ($user) {
            return (in_array('register_request.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('register_request.restore', function ($user) {
            return (in_array('register_request.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('register_request.forceDelete', function ($user) {
            return (in_array('register_request.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });




                Gate::define('role.index', function ($user) {
            return (in_array('role.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.create', function ($user) {
            return (in_array('role.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.update', function ($user) {
            return (in_array('role.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.delete', function ($user) {
            return (in_array('role.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.restore', function ($user) {
            return (in_array('role.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.forceDelete', function ($user) {
            return (in_array('role.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('permission.index', function ($user) {
            return (in_array('permission.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('permission.create', function ($user) {
            return (in_array('permission.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('permission.update', function ($user) {
            return (in_array('permission.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('permission.delete', function ($user) {
            return (in_array('permission.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('permission.restore', function ($user) {
            return (in_array('permission.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('permission.forceDelete', function ($user) {
            return (in_array('permission.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


               Gate::define('roleuser.index', function ($user) {
            return (in_array('roleuser.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('roleuser.create', function ($user) {
            return (in_array('roleuser.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('roleuser.update', function ($user) {
            return (in_array('roleuser.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('roleuser.delete', function ($user) {
            return (in_array('roleuser.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('roleuser.restore', function ($user) {
            return (in_array('roleuser.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('roleuser.forceDelete', function ($user) {
            return (in_array('roleuser.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });


             Gate::define('color.index', function ($user) {
            return (in_array('color.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('color.create', function ($user) {
            return (in_array('color.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('color.update', function ($user) {
            return (in_array('color.update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('color.delete', function ($user) {
            return (in_array('color.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('color.restore', function ($user) {
            return (in_array('color.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('color.forceDelete', function ($user) {
            return (in_array('color.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });
}}
