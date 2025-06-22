<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('color.index');
        $page = 'index';
        $color = Color::get();
        return view('Dashboard.Color.index', compact('color', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('color.create');
        $page = 'create';
        $color = new Color();

        return view('Dashboard.Color.create', compact('page', 'color'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Gate::authorize('color.create');
        $request->validate([
            'color' => 'required',
        ]);

        $color = Color::create(['name' => $request->color]);

        return redirect()->route('Dashboard.color.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('color.restore');
        Color::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.color.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('color.index');
        $color = Color::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Color.index', compact('color', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('color.update');

        $color = Color::find($id);
        $page = 'edit';
        return view('Dashboard.Color.edit', compact('color', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('color.update');
        $request->validate([

            'color' => 'required',
        ]);
        Color::find($id)->update([

            'name' => $request->color
        ]);

        return redirect()->route('Dashboard.color.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('color.delete');
        Color::find($id)->delete();
        return redirect()->route('Dashboard.color.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('color.forceDelete');
        Color::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.color.index');
    }
}
