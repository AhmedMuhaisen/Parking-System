<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('role.index');
        $page = 'index';
        $role = Role::get();
        return view('Dashboard.Role.index', compact('role', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('role.create');
        $page = 'create';
        $permission = Permission::get();
        $role = new Role();
        return view('Dashboard.Role.create', compact('page', 'role', 'permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('role.create');
        $request->validate([

            'name' => 'required',
        ]);

        $role=$role = Role::create(['name' => $request->name]);
        $role->permission()->sync($request->permissions);$notifier->trigger('role', 'create', $role);
        return redirect()->route('Dashboard.role.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('role.restore');
        $role= Role::withTrashed()->find($id)->restore();$notifier->trigger('role', 'restore', $role);
        return redirect()->route('Dashboard.role.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('role.index');
        $role = Role::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Role.index', compact('role', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('role.update');
        $permission = Permission::get();
        $role = Role::find($id);
        $page = 'edit';
        return view('Dashboard.Role.edit', compact('role', 'page', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('role.update');
        $request->validate([

            'name' => 'required',
        ]);
        $role=Role::find($id)->update([

            'name' => $request->name
        ]);

        $role = Role::find($id);
        $role->permission()->sync($request->permissions);$notifier->trigger('role', 'edit', $role);
        return redirect()->route('Dashboard.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('role.delete');
        $role=Role::find($id)->delete(); $notifier->trigger('role', 'delete', $role);
        return redirect()->route('Dashboard.role.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('role.forceDelete');
        $role=Role::withTrashed()->find($id)->forceDelete();
$notifier->trigger('role', 'softDelete', $role);
        return redirect()->route('Dashboard.role.index');
    }
}
