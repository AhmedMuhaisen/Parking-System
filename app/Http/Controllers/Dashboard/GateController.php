<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CategoriesExport;
use App\Exports\GatesExport;
use App\Http\Controllers\Controller;
use App\Models\Gate as GateModel;
use App\Models\Parking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class GateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('gate.index');


        $page = 'index';
        $gate = GateModel::get();
        return view('Dashboard.Gate.index', compact('gate', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $categories = GateModel::search($request);
        $result = $categories->get();
        $html = view('Dashboard.Gate.table', [
            'gate' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$gates=GateModel::search($request);
$result=$gates->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'gates' => $result];

        $pdf = Pdf::loadView('Dashboard.Gate.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape');

        return $pdf->download('gate.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new GatesExport($request), 'gates.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('gate.create');
        $page = 'create';
        $folder = '';
        $parkings=Parking::get();
        $gate = new GateModel();
        return view('Dashboard.Gate.create', compact('page', 'parkings','gate', 'folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('gate.create');
      $request->validate([
            'name' => 'required',
            'address' => 'required',
           'type'=>'required',
           'parking'=>'required',

           'open_method'=>'required',
           'status'=>'required',


        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('gate', 'new');
        GateModel::create([
           'name' => $request->name,
           'address' => $request->address,
            'open_method' => $request->open_method,
            'parking_id' => $request->parking,
            'type' => $request->type,
            'status' => $request->status,


        ]);
        return redirect()->route('Dashboard.gate.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('gate.restore');
        GateModel::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.gate.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('gate.index');
        $gate = GateModel::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Gate.index', compact('gate', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('gate.update');
        $folder = 'gate';
        $gate = GateModel::find($id);
        $parkings=Parking::get();
        $page = 'edit';

        return view('Dashboard.Gate.edit', compact('gate','parkings' ,'page', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('gate.update');
        $request->validate([
            'name' => 'required',
             'address' => 'required',
           'open_method'=>'required',
           'type'=>'required',
           'parking'=>'required',
           'status'=>'required',


        ]);

        $gate = GateModel::find($id);

        $gate->update([
            'name' => $request->name,
            'address' => $request->address,
            'type' => $request->type,
            'parking_id' => $request->parking,
             'open_method' => $request->open_method,
            'status' => $request->status,


        ]);
        return redirect()->route('Dashboard.gate.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('gate.delete');
        GateModel::find($id)->delete();
        return redirect()->route('Dashboard.gate.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('gate.forceDelete');
        GateModel::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.gate.index');
    }
}
