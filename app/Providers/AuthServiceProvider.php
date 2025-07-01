<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('User.index', function ($user) {
            return (in_array('User.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('User.create', function ($user) {
            return (in_array('User.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('User.Update', function ($user) {
            return (in_array('User.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('User.delete', function ($user) {
            return (in_array('User.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('User.restore', function ($user) {
            return (in_array('User.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('User.forceDelete', function ($user) {
            return (in_array('User.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Subscribe.index', function ($user) {
            return (in_array('Subscribe.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Subscribe.create', function ($user) {
            return (in_array('Subscribe.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Subscribe.Update', function ($user) {
            return (in_array('Subscribe.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Subscribe.delete', function ($user) {
            return (in_array('Subscribe.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Subscribe.restore', function ($user) {
            return (in_array('Subscribe.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Subscribe.forceDelete', function ($user) {
            return (in_array('Subscribe.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Setting.index', function ($user) {
            return (in_array('Setting.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Setting.create', function ($user) {
            return (in_array('Setting.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Setting.Update', function ($user) {
            return (in_array('Setting.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Setting.delete', function ($user) {
            return (in_array('Setting.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Setting.restore', function ($user) {
            return (in_array('Setting.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Setting.forceDelete', function ($user) {
            return (in_array('Setting.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Product.index', function ($user) {
            return (in_array('Product.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Product.create', function ($user) {
            return (in_array('Product.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Product.Update', function ($user) {
            return (in_array('Product.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Product.delete', function ($user) {
            return (in_array('Product.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Product.restore', function ($user) {
            return (in_array('Product.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Product.forceDelete', function ($user) {
            return (in_array('Product.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });



        Gate::define('Message.index', function ($user) {
            return (in_array('Message.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Message.create', function ($user) {
            return (in_array('Message.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Message.Update', function ($user) {
            return (in_array('Message.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Message.delete', function ($user) {
            return (in_array('Message.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Message.restore', function ($user) {
            return (in_array('Message.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Message.forceDelete', function ($user) {
            return (in_array('Message.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Category.index', function ($user) {
            return (in_array('Category.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Category.create', function ($user) {
            return (in_array('Category.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Category.Update', function ($user) {
            return (in_array('Category.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Category.delete', function ($user) {
            return (in_array('Category.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Category.restore', function ($user) {
            return (in_array('Category.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('Category.forceDelete', function ($user) {
            return (in_array('Category.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });




        Gate::define('role.index', function ($user) {
            return (in_array('role.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.create', function ($user) {
            return (in_array('role.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role.Update', function ($user) {
            return (in_array('role.Update', $user->role->permission->pluck('code')->toArray()));
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

        Gate::define('permission.Update', function ($user) {
            return (in_array('permission.Update', $user->role->permission->pluck('code')->toArray()));
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





        Gate::define('role-permission.index', function ($user) {
            return (in_array('role-permission.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-permission.create', function ($user) {
            return (in_array('role-permission.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-permission.Update', function ($user) {
            return (in_array('role-permission.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-permission.delete', function ($user) {
            return (in_array('role-permission.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-permission.restore', function ($user) {
            return (in_array('role-permission.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-permission.forceDelete', function ($user) {
            return (in_array('role-permission.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });




        Gate::define('role-user.index', function ($user) {
            return (in_array('role-user.index', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-user.create', function ($user) {
            return (in_array('role-user.create', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-user.Update', function ($user) {
            return (in_array('role-user.Update', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-user.delete', function ($user) {
            return (in_array('role-user.delete', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-user.restore', function ($user) {
            return (in_array('role-user.restore', $user->role->permission->pluck('code')->toArray()));
        });

        Gate::define('role-user.forceDelete', function ($user) {
            return (in_array('role-user.forceDelete', $user->role->permission->pluck('code')->toArray()));
        });
    }
}
