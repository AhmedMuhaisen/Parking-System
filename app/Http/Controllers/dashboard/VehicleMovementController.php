<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\VehiclesMovementExport;
use App\Http\Controllers\Controller;
use App\Models\Gate as ModelsGate;
use App\Models\Gates;
use App\Models\Vehicle;
use App\Models\VehiclesMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class VehicleMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('vehiclesMovement.index');

        $page = 'index';
        $vehicleMovement = VehiclesMovement::get();
        $gate = ModelsGate::get();


        return view('Dashboard.VehicleMovement.index', compact('vehicleMovement', 'page' ,'gate'  ));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $vehicleMovements = VehiclesMovement::search($request);
        $result = $vehicleMovements->get();
        $html = view('Dashboard.VehicleMovement.table', [
            'vehicleMovement' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$vehicleMovements=VehiclesMovement::search($request);
$result=$vehicleMovements->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'vehicleMovements' => $result];

        $pdf = Pdf::loadView('Dashboard.VehicleMovement.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape');

        return $pdf->download('vehicleMovement.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new VehiclesMovementExport($request), 'vehicleMovements.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('vehiclesMovement.create');
        $gate = Gates::get();
         $vehicles = Vehicle::get();
         $page = 'create';
        $folder = '';
        $vehicleMovement = new VehiclesMovement();
        return view('Dashboard.VehicleMovement.create', compact('page', 'vehicleMovement', 'folder' ,'vehicles','gate' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('vehiclesMovement.create');
       $request->validate([
        'vehicle_number'=>['required'],
        'gate'=>['required'],
        'method_passage'=>['required'],
        'type_movement'=>['required'],
        'date'=>'required|date',
        'time'=>'required|max:40',
        ]);

        VehiclesMovement::Create([
            'vehicle_id'=>$request->vehicle_number,
        'gate_id'=>$request->gate,
        'method_passage'=>$request->method_passage,
        'type_movement'=>$request->type_movement,
        'date'=>$request->date,
        'time'=>$request->time,
        ]);
        return redirect()->route('Dashboard.vehicleMovement.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('vehiclesMovement.restore');
        VehiclesMovement::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.vehicleMovement.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('vehiclesMovement.index');

        $page = 'trash';
         $vehicleMovement = VehiclesMovement::onlyTrashed()->get();
        $gate = ModelsGate::get();


        return view('Dashboard.VehicleMovement.index', compact('vehicleMovement', 'page' ,'gate'  ));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('vehiclesMovement.update');

  $gate = Gates::get();
         $vehicles = Vehicle::get();
        $vehicleMovement = VehiclesMovement::find($id);
        $page = 'edit';
        return view('Dashboard.VehicleMovement.edit', compact('page', 'vehicleMovement','vehicles','gate' ));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('vehiclesMovement.update');
            $request->validate([
        'vehicle_number'=>['required'],
        'gate'=>['required'],
        'method_passage'=>['required'],
        'type_movement'=>['required'],
        'date'=>'required|date',
        'time'=>'required|max:40',
        ]);

           $vehicleMovement = VehiclesMovement::find($id);

        $vehicleMovement->update([
                'vehicle_id'=>$request->vehicle_number,
        'gate_id'=>$request->gate,
        'method_passage'=>$request->method_passage,
        'type_movement'=>$request->type_movement,
        'date'=>$request->date,
        'time'=>$request->time,
        ]);
        return redirect()->route('Dashboard.vehicleMovement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('vehiclesMovement.delete');
        VehiclesMovement::find($id)->delete();
        return redirect()->route('Dashboard.vehicleMovement.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('vehiclesMovement.forceDelete');
        VehiclesMovement::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.vehicleMovement.index');
    }
}
