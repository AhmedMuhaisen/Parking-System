<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Services\NotificationService;
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
        return view('Dashboard.Permission.index', compact('permission', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('permission.create');
        $page = 'create';
        $permission = new Permission();
        return view('Dashboard.Permission.create', compact('page', 'permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('permission.create');
        $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);
        $permission=Permission::create([
            'code' => $request->code,
            'description' => $request->description
        ]);$notifier->trigger('permission', 'create', $permission);
        return redirect()->route('Dashboard.permission.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('permission.restore');
        $permission= Permission::withTrashed()->find($id)->restore();$notifier->trigger('permission', 'restore', $permission);
        return redirect()->route('Dashboard.permission.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('permission.index');
        $permission = Permission::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Permission.index', compact('permission', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('permission.update');
        $permission = Permission::find($id);
        $page = 'edit';
        return view('Dashboard.Permission.edit', compact('permission', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('permission.update');
        $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);
        $permission=Permission::find($id)->update([
            'code' => $request->code,
            'description' => $request->description
        ]);$notifier->trigger('permission', 'edit', $permission);
        return redirect()->route('Dashboard.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('permission.delete');
       $permission= Permission::find($id)->delete(); $notifier->trigger('permission', 'delete', $permission);
        return redirect()->route('Dashboard.permission.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('permission.forceDelete');
        $permission=Permission::withTrashed()->find($id)->forceDelete();
$notifier->trigger('permission', 'softDelete', $permission);
        return redirect()->route('Dashboard.permission.index');
    }
}
