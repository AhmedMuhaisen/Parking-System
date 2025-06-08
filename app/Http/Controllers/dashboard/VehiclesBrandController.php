<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\VehiclesBrandsExport;
use App\Http\Controllers\Controller;
use App\Models\VehiclesBrand;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class VehiclesBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('vehiclesBrand.index');


        $page = 'index';
        $vehiclesBrand = vehiclesBrand::get();
        return view('Dashboard.vehiclesBrand.index', compact('vehiclesBrand', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $vehiclesBrands = VehiclesBrand::search($request);
        $result = $vehiclesBrands->get();
        $html = view('Dashboard.vehiclesBrand.table', [
            'vehiclesBrand' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$vehiclesBrands=VehiclesBrand::search($request);
$result=$vehiclesBrands->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'vehiclesBrands' => $result];

        $pdf = Pdf::loadView('Dashboard.vehiclesBrand.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape');

        return $pdf->download('vehiclesBrand.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new VehiclesBrandsExport($request), 'vehiclesBrands.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('vehiclesBrand.create');
        $page = 'create';
        $folder = '';
        $vehiclesBrand = new vehiclesBrand();
        return view('Dashboard.VehiclesBrand.create', compact('page', 'vehiclesBrand', 'folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('vehiclesBrand.create');
      $request->validate([
            'name' => 'required',
         ]);
        // $image = $request->image;
        // $image = $image->storePublicly('vehiclesBrand', 'new');
        VehiclesBrand::create([
           'name' => $request->name,

        ]);
        return redirect()->route('Dashboard.vehiclesBrand.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('vehiclesBrand.restore');
        VehiclesBrand::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.vehiclesBrand.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('vehiclesBrand.index');
        $vehiclesBrand = VehiclesBrand::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.VehiclesBrand.index', compact('vehiclesBrand', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('vehiclesBrand.update');
        $folder = 'vehiclesBrand';
        $vehiclesBrand = VehiclesBrand::find($id);
        $page = 'edit';
        return view('Dashboard.VehiclesBrand.edit', compact('vehiclesBrand', 'page', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('vehiclesBrand.update');
        $request->validate([
            'name' => 'required',
           ]);

        $vehiclesBrand = VehiclesBrand::find($id);

        $vehiclesBrand->update([
            'name' => $request->name,

        ]);
        return redirect()->route('Dashboard.vehiclesBrand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('vehiclesBrand.delete');
        VehiclesBrand::find($id)->delete();
        return redirect()->route('Dashboard.vehiclesBrand.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('vehiclesBrand.forcedelete');
        VehiclesBrand::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.vehiclesBrand.index');
    }
}
