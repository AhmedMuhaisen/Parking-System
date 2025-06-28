<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\BuildingsExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Parking;
use App\Models\User;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('building.index');


        $page = 'index';
        $building = Building::with([
            'users.vehicle',
            'unit',
        ])->get();
        return view('Dashboard.Building.index', compact('building', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $buildings = Building::search($request);
        $result = $buildings->get();
        $html = view('Dashboard.Building.table', [
            'building' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $buildings = Building::search($request);
        $result = $buildings->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'buildings' => $result];

        $pdf = Pdf::loadView('Dashboard.Building.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('building.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new BuildingsExport($request), 'buildings.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('building.create');
        $page = 'create';
        $folder = '';
        $parkings = Parking::get();

        $users = User::get();
        $building = new building();


        return view('Dashboard.Building.create', compact('page', 'building', 'folder', 'users', 'parkings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , NotificationService $notifier)
    {
        Gate::authorize('building.create');
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'user' => ['required','exists:users,id'],
            'parking' => ['required','exists:parkings,id'],
            'max_units' => 'required | max:10',
            'max_users' => 'required | max:10',
            'max_vehicles' => 'required | max:10',
            'max_spots' => 'required | max:10',
            'max_guests' => 'required | max:10',
        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('building', 'new');
       $building= Building::create([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => $request->user,
            'parking_id' => $request->parking,
            'max_units' => $request->max_units,
            'max_users' => $request->max_users,
            'max_vehicles' => $request->max_vehicles,
            'max_spots' => $request->max_spots,
            'max_guests' => $request->max_guests,
        ]);
              $notifier->trigger('building', 'create', $building);
        return redirect()->route('Dashboard.building.index');
    }

    public function restore(string $id , NotificationService $notifier)
    {
        Gate::authorize('building.restore');
       $building= Building::withTrashed()->find($id)->restore();
             $notifier->trigger('building', 'restore', $building);
        return redirect()->route('Dashboard.building.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('building.index');
        $building = Building::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Building.index', compact('building', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('building.update');

        $building = Building::find($id);
        $page = 'edit';
$parkings=Parking::get();
          $users = User::get();
        return view('Dashboard.Building.edit', compact('page', 'building','parkings' ,  'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id , NotificationService $notifier)
    {
        Gate::authorize('building.update');
        $request->validate([
             'name' => 'required',
             'address' => 'required',
             'user' => ['required','exists:users,id'],
            'parking' => ['required','exists:parkings,id'],
            'max_units' => 'required | max:10',
            'max_users' => 'required | max:10',
            'max_vehicles' => 'required | max:10',
            'max_spots' => 'required | max:10',
            'max_guests' => 'required | max:10',
        ]);

       $building = Building::find($id);

        $building->update([
       'name' => $request->name,
       'address' => $request->address,

       'user_id' => $request->user,
            'parking_id' => $request->parking,
            'max_units' => $request->max_units,
            'max_users' => $request->max_users,
            'max_vehicles' => $request->max_vehicles,
            'max_spots' => $request->max_spots,
            'max_guests' => $request->max_guests,
        ]);
               $notifier->trigger('building', 'edit', $building);
        return redirect()->route('Dashboard.building.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id , NotificationService $notifier)
    {
        Gate::authorize('building.delete');
      $building=  Building::find($id)->delete();
            $notifier->trigger('building', 'delete', $building);
        return redirect()->route('Dashboard.building.index');
    }

    public function delete(string $id , NotificationService $notifier)
    {
        Gate::authorize('building.forceDelete');
       $building= Building::withTrashed()->find($id)->forceDelete();
      $notifier->trigger('building', 'softDelete', $building);
        return redirect()->route('Dashboard.building.index');
    }
}
