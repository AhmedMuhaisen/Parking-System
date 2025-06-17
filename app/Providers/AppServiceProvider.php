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
    }
}
