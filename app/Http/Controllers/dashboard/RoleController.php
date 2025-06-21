<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\role;
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
        return view('Dashboard.role.index', compact('role', 'page'));
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
        return view('Dashboard.role.create', compact('page', 'role', 'permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('role.create');
        $request->validate([

            'name' => 'required',
        ]);

        $role = role::create(['name' => $request->name]);
        $role->permission()->sync($request->permissions);
        return redirect()->route('Dashboard.role.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('role.restore');
        Role::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.role.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('role.index');
        $role = Role::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.role.index', compact('role', 'page'));
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
        return view('Dashboard.role.edit', compact('role', 'page', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('role.update');
        $request->validate([

            'name' => 'required',
        ]);
        Role::find($id)->update([

            'name' => $request->name
        ]);

        $role = role::find($id);
        $role->permission()->sync($request->permissions);
        return redirect()->route('Dashboard.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('role.delete');
        Role::find($id)->delete();
        return redirect()->route('Dashboard.role.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('role.forcedelete');
        Role::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.role.index');
    }
}
