<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CamerasExport;
use App\Http\Controllers\Controller;
use App\Models\Gate as GateModel;
use App\Models\Camera;
use App\Models\Parking;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('camera.index');


        $page = 'index';
        $camera = Camera::with([
            'gate.parking',
            'gate',
        ])->get();
$parkings=Parking::get();
$gates=GateModel::get();

        return view('Dashboard.Camera.index', compact('camera', 'page','gates','parkings'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $cameras = Camera::search($request);
        $result = $cameras->get();
        $html = view('Dashboard.Camera.table', [
            'camera' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $cameras = Camera::search($request);
        $result = $cameras->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'cameras' => $result];

        $pdf = Pdf::loadView('Dashboard.Camera.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('camera.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {

        return Excel::download(new camerasExport($request), 'cameras.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('camera.create');
        $page = 'create';
        $folder = '';
        $parkings = Parking::get();
        $gates = GateModel::get();
        $camera = new camera();
        return view('Dashboard.Camera.create', compact('page', 'camera', 'parkings' , 'gates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('camera.create');
        $request->validate([
            'name' => 'required',
            'gate' => ['required','exists:gates,id'],

        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('camera', 'new');
        Camera::create([
            'name' => $request->name,
            'gate_id' => $request->gate,

        ]);
        return redirect()->route('Dashboard.camera.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('camera.restore');
        Camera::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.camera.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('camera.index');
        $camera = Camera::onlyTrashed()->get();
        $page = 'trash';
        $parkings=Parking::get();
$gates=GateModel::get();
        return view('Dashboard.Camera.index', compact('camera', 'page','gates','parkings'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('camera.update');

        $camera = Camera::find($id);
        $page = 'edit';
$parkings=Parking::get();
$gates=GateModel::get();


        return view('Dashboard.Camera.edit', compact('page', 'camera','parkings' ,'gates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('camera.update');
        $request->validate([
             'name' => 'required',
             'user' => ['required','exists:users,id'],
            'gate' => ['required','exists:gates,id'],

             'parking' => ['required','exists:parkings,id'],
        ]);

        $camera = Camera::find($id);

        $camera->update([
       'name' => $request->name,

       'user_id' => $request->user,
            'gate_id' => $request->gate,

        ]);
        return redirect()->route('Dashboard.camera.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('camera.delete');
        Camera::find($id)->delete();
        return redirect()->route('Dashboard.camera.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('camera.forceDelete');
        Camera::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.camera.index');
    }
}
