<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\ParkingsExport;
use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\User;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('parking.index');


        $page = 'index';
        $parking = Parking::with([
            'buildings.users.vehicle',
            'buildings.unit',
        ])->get();
        return view('Dashboard.Parking.index', compact('parking', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $parkings = Parking::search($request);
        $result = $parkings->get();
        $html = view('Dashboard.Parking.table', [
            'parking' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $parkings = Parking::search($request);
        $result = $parkings->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'parkings' => $result];

        $pdf = Pdf::loadView('Dashboard.Parking.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('parking.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new ParkingsExport($request), 'parkings.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('parking.create');
        $page = 'create';
        $folder = '';
        $users = User::get();
        $parking = new Parking();
        return view('Dashboard.Parking.create', compact('page', 'parking', 'folder', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('parking.create');
        $request->validate([
            'name' => 'required',
            'user' => ['required','exists:users,id'],
            'max_buildings' => 'required | max:10',
            'max_units' => 'required | max:10',
            'max_gates' => 'required | max:10',
            'max_users' => 'required | max:10',
            'max_vehicles' => 'required | max:10',
            'max_cameras' => 'required | max:10',
            'max_spots' => 'required | max:10',
            'max_guests' => 'required | max:10',
        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('parking', 'new');
       $parking= Parking::create([
            'name' => $request->name,
            'user_id' => $request->user,
            'max_buildings' => $request->max_buildings,
            'max_units' => $request->max_units,
            'max_gates' => $request->max_gates,
            'max_users' => $request->max_users,
            'max_vehicles' => $request->max_vehicles,
            'max_cameras' => $request->max_cameras,
            'max_spots' => $request->max_spots,
            'max_guests' => $request->max_guests,
        ]);$notifier->trigger('parking', 'create', $parking);
        return redirect()->route('Dashboard.parking.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('parking.restore');
         $parking=Parking::withTrashed()->find($id)->restore();$notifier->trigger('parking', 'restore', $parking);
        return redirect()->route('Dashboard.parking.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('parking.index');
        $parking = Parking::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Parking.index', compact('parking', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('parking.update');

        $parking = Parking::find($id);
        $page = 'edit';
          $users = User::get();
        return view('Dashboard.Parking.edit', compact('page', 'parking',  'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('parking.update');
        $request->validate([
               'name' => 'required',
            'user' => ['required','exists:users,id'],
            'max_buildings' => 'required | max:10',
            'max_units' => 'required | max:10',
            'max_gates' => 'required | max:10',
            'max_users' => 'required | max:10',
            'max_vehicles' => 'required | max:10',
            'max_cameras' => 'required | max:10',
            'max_spots' => 'required | max:10',
            'max_guests' => 'required | max:10',
        ]);

       $parking= Parking::find($id);

        $parking->update([
             'name' => $request->name,
            'user_id' => $request->user,
            'max_buildings' => $request->max_buildings,
            'max_units' => $request->max_units,
            'max_gates' => $request->max_gates,
            'max_users' => $request->max_users,
            'max_vehicles' => $request->max_vehicles,
            'max_cameras' => $request->max_cameras,
            'max_spots' => $request->max_spots,
            'max_guests' => $request->max_guests,
        ]);$notifier->trigger('parking', 'edit', $parking);
        return redirect()->route('Dashboard.parking.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('parking.delete');
       $parking= Parking::find($id)->delete(); $notifier->trigger('parking', 'delete', $parking);
        return redirect()->route('Dashboard.parking.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('parking.forceDelete');
       $parking= Parking::withTrashed()->find($id)->forceDelete();
$notifier->trigger('parking', 'softDelete', $parking);
        return redirect()->route('Dashboard.parking.index');
    }
}
