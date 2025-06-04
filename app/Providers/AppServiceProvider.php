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

    }
}
