<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\VehiclesTypesExport;
use App\Http\Controllers\Controller;
use App\Models\vehiclesType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class VehiclesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('vehiclesType.index');


        $page = 'index';
        $vehiclesType = VehiclesType::get();
        return view('Dashboard.VehiclesType.index', compact('vehiclesType', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $vehiclesTypes = vehiclesType::search($request);
        $result = $vehiclesTypes->get();
        $html = view('Dashboard.vehiclesType.table', [
            'vehiclesType' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$vehiclesTypes=vehiclesType::search($request);
$result=$vehiclesTypes->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'vehiclesTypes' => $result];

        $pdf = Pdf::loadView('Dashboard.vehiclesType.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape');

        return $pdf->download('vehiclesType.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new VehiclesTypesExport($request), 'vehiclesTypes.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('vehiclesType.create');
        $page = 'create';
        $folder = '';
        $vehiclesType = new VehiclesType();
        return view('Dashboard.VehiclesType.create', compact('page', 'vehiclesType', 'folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('vehiclesType.create');
      $request->validate([
            'name' => 'required',
         ]);
        // $image = $request->image;
        // $image = $image->storePublicly('vehiclesType', 'new');
        VehiclesType::create([
           'name' => $request->name,

        ]);
        return redirect()->route('Dashboard.vehiclesType.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('vehiclesType.restore');
        VehiclesType::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.vehiclesType.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('vehiclesType.index');
        $vehiclesType = VehiclesType::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.VehiclesType.index', compact('vehiclesType', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('vehiclesType.update');
        $folder = 'vehiclesType';
        $vehiclesType = VehiclesType::find($id);
        $page = 'edit';
        return view('Dashboard.vehiclesType.edit', compact('vehiclesType', 'page', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('vehiclesType.update');
        $request->validate([
            'name' => 'required',
           ]);

        $vehiclesType = VehiclesType::find($id);

        $vehiclesType->update([
            'name' => $request->name,

        ]);
        return redirect()->route('Dashboard.vehiclesType.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('vehiclesType.delete');
        VehiclesType::find($id)->delete();
        return redirect()->route('Dashboard.vehiclesType.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('vehiclesType.forcedelete');
        VehiclesType::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.vehiclesType.index');
    }
}
