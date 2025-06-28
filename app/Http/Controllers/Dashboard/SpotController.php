<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\SpotsExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Spot;
use App\Models\Parking;
use App\Models\User;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('spot.index');


        $page = 'index';
        $spot = Spot::with([
            'building.parking',
            'building',
        ])->get();
$parkings=Parking::get();
$buildings=Building::get();

        return view('Dashboard.Spot.index', compact('spot', 'page','buildings','parkings'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $spots = Spot::search($request);
        $result = $spots->get();
        $html = view('Dashboard.Spot.table', [
            'spot' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $spots = Spot::search($request);
        $result = $spots->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'spots' => $result];

        $pdf = Pdf::loadView('Dashboard.Spot.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('spot.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {

        return Excel::download(new SpotsExport($request), 'spots.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('spot.create');
        $page = 'create';
        $folder = '';
        $parkings = Parking::get();
        $buildings = Building::get();
        $spot = new Spot();
        return view('Dashboard.Spot.create', compact('page', 'spot', 'parkings' , 'buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('spot.create');
        $request->validate([
            'name' => 'required',
            'type' => ['required'],
            'parking' => ['required','exists:parkings,id'],
            'building' => ['required','exists:buildings,id'],

        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('spot', 'new');
        $spot=Spot::create([
            'name' => $request->name,
            'type' => $request->type,
            'building_id' => $request->building,

        ]);$notifier->trigger('spot', 'create', $spot);
        return redirect()->route('Dashboard.spot.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('spot.restore');
        $spot= Spot::withTrashed()->find($id)->restore();$notifier->trigger('spot', 'restore', $spot);
        return redirect()->route('Dashboard.spot.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('spot.index');
        $spot = Spot::onlyTrashed()->get();
        $page = 'trash';
        $parkings=Parking::get();
$buildings=Building::get();
        return view('Dashboard.Spot.index', compact('spot', 'page','buildings','parkings'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('spot.update');

        $spot = Spot::find($id);
        $page = 'edit';
$parkings=Parking::get();
$buildings=Building::get();

          $users = User::get();
        return view('Dashboard.Spot.edit', compact('page', 'spot','parkings' ,'buildings' ,  'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('spot.update');
        $request->validate([
             'name' => 'required',
             'type' => ['required'],
            'building' => ['required','exists:buildings,id'],

             'parking' => ['required','exists:parkings,id'],
        ]);

        $spot= Spot::find($id);

        $spot->update([
       'name' => $request->name,

       'type' => $request->type,
            'building_id' => $request->building,

        ]);$notifier->trigger('spot', 'edit', $spot);
        return redirect()->route('Dashboard.spot.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('spot.delete');
        $spot=Spot::find($id)->delete(); $notifier->trigger('spot', 'delete', $spot);
        return redirect()->route('Dashboard.spot.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('spot.forceDelete');
       $spot= Spot::withTrashed()->find($id)->forceDelete();
$notifier->trigger('spot', 'softDelete', $spot);
        return redirect()->route('Dashboard.spot.index');
    }
}
