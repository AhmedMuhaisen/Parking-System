<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UnitsExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Unit;
use App\Models\Parking;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('unit.index');


        $page = 'index';
        $unit = Unit::with([
            'building.parking',
            'building',
        ])->get();
        return view('Dashboard.Unit.index', compact('unit', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $units = Unit::search($request);
        $result = $units->get();
        $html = view('Dashboard.Unit.table', [
            'unit' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $units = Unit::search($request);
        $result = $units->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'units' => $result];

        $pdf = Pdf::loadView('Dashboard.Unit.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('unit.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new UnitsExport($request), 'units.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('unit.create');
        $page = 'create';
        $folder = '';
        $parkings = Parking::get();
        $buildings = Building::get();

        $users = User::get();
        $unit = new unit();
        return view('Dashboard.Unit.create', compact('page', 'unit', 'users', 'parkings' , 'buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('unit.create');
        $request->validate([
            'name' => 'required',
            'user' => ['required','exists:users,id'],
            'parking' => ['required','exists:parkings,id'],
            'building' => ['required','exists:buildings,id'],

        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('unit', 'new');
        Unit::create([
            'name' => $request->name,
            'user_id' => $request->user,
            'building_id' => $request->building,

        ]);
        return redirect()->route('Dashboard.unit.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('unit.restore');
        Unit::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.unit.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('unit.index');
        $unit = Unit::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Unit.index', compact('unit', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('unit.update');

        $unit = Unit::find($id);
        $page = 'edit';
$parkings=Parking::get();
$buildings=Building::get();

          $users = User::get();
        return view('Dashboard.Unit.edit', compact('page', 'unit','parkings' ,'buildings' ,  'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('unit.update');
        $request->validate([
             'name' => 'required',
             'user' => ['required','exists:users,id'],
            'building' => ['required','exists:buildings,id'],

             'parking' => ['required','exists:parkings,id'],
        ]);

        $unit = Unit::find($id);

        $unit->update([
       'name' => $request->name,

       'user_id' => $request->user,
            'building_id' => $request->building,

        ]);
        return redirect()->route('Dashboard.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('unit.delete');
        Unit::find($id)->delete();
        return redirect()->route('Dashboard.unit.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('unit.forceDelete');
        Unit::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.unit.index');
    }
}
