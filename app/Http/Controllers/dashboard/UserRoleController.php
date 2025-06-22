<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('roleuser.index');
        $user = User::where('role_id', '!=', 0)->get();
        return view('Dashboard.UserRole.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('roleuser.create');
        $user = new User();
        $role = Role::get();
        $users = User::where('role_id', '=', 0)->get();
        return view('Dashboard.UserRole.edit', compact('user', 'users', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */




    public function edit(string $id)
    {
        Gate::authorize('roleuser.update');
        $user = User::find($id);
        $users = User::get();
        $role = Role::get();
        return view('Dashboard.UserRole.edit', compact('user', 'users', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Gate::authorize('roleuser.update');
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
        $user = User::findOrFail($request->user_id);
        $user->update([
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('Dashboard.user_role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('roleuser.delete');

        User::find($id)->update([
            'role_id' => 0
        ]);
        return redirect()->route('Dashboard.user_role.index');
    }
}
