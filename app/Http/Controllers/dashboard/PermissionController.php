<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('permission.index');
        $page = 'index';
        $permission = Permission::get();
        return view('Dashboard.permission.index', compact('permission', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('permission.create');
        $page = 'create';
        $permission = new Permission();
        return view('Dashboard.permission.create', compact('page', 'permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('permission.create');
        $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);
        Permission::create([
            'code' => $request->code,
            'description' => $request->description
        ]);
        return redirect()->route('Dashboard.permission.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('permission.restore');
        Permission::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.permission.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('permission.index');
        $permission = Permission::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.permission.index', compact('permission', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('permission.Update');
        $permission = Permission::find($id);
        $page = 'edit';
        return view('Dashboard.permission.edit', compact('permission', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('permission.Update');
        $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);
        Permission::find($id)->update([
            'code' => $request->code,
            'description' => $request->description
        ]);
        return redirect()->route('Dashboard.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('permission.delete');
        Permission::find($id)->delete();
        return redirect()->route('Dashboard.permission.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('permission.forcedelete');
        Permission::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.permission.index');
    }
}
