<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\parking_worksExport;
use App\Http\Controllers\Controller;
use App\Models\ParkingWork;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class Parking_WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('parking_work.index');


        $page = 'index';
        $parking_work = ParkingWork::get();
        return view('Dashboard.Parking_Work.index', compact('parking_work', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $parking_works = ParkingWork::search($request);
        $result = $parking_works->get();
        $html = view('Dashboard.Parking_Work.table', [
            'parking_work' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$parking_works=ParkingWork::search($request);
$result=$parking_works->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'parking_works' => $result];

        $pdf = Pdf::loadView('Dashboard.Parking_Work.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape');

        return $pdf->download('parking_work.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new Parking_WorksExport($request), 'parking_works.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('parking_work.create');
        $page = 'create';

        $parking_work = new ParkingWork();
        return view('Dashboard.Parking_Work.create', compact('page', 'parking_work'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,NotificationService $notifier)
    {
        Gate::authorize('parking_work.create');
      $request->validate([
            'icon' => 'required',
           'title'=>'required',
           'step' => 'required|unique:parking_works,step',
           'content'=>'required',

        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('parking_work', 'new');
          $parking_work= ParkingWork::create([
           'icon' => $request->icon,
            'title' => $request->title,
            'step' => $request->step,
            'content' => $request->content

        ]);

         $notifier->trigger('parking_work', 'create', $parking_work);
        return redirect()->route('Dashboard.parking_work.index');
    }

    public function restore(string $id ,NotificationService $notifier)
    {
        Gate::authorize('parking_work.restore');
        $parking_work=  ParkingWork::withTrashed()->find($id)->restore();  $notifier->trigger('parking_work', 'restore', $parking_work);
        return redirect()->route('Dashboard.parking_work.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('parking_work.index');
        $parking_work = ParkingWork::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Parking_Work.index', compact('parking_work', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('parking_work.update');
        $folder = 'parking_work';
        $parking_work = ParkingWork::find($id);
        $page = 'edit';
        return view('Dashboard.Parking_Work.edit', compact('parking_work', 'page', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id ,NotificationService $notifier)
    {
        Gate::authorize('parking_work.update');
        $request->validate([
            'icon' => 'required',
           'title'=>'required',
           'step' => 'required|unique:parking_works,step',
           'content'=>'required',

        ]);

        $parking_work = ParkingWork::find($id);

        $parking_work->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'step' => $request->step,
            'content' => $request->content,
        ]);
        $notifier->trigger('parking_work', 'edit', $parking_work);
        return redirect()->route('Dashboard.parking_work.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id ,NotificationService $notifier)
    {
        Gate::authorize('parking_work.delete');
         $parking_work=ParkingWork::find($id)->delete();
         $notifier->trigger('parking_work', 'delete', $parking_work);
        return redirect()->route('Dashboard.parking_work.index');
    }

    public function delete(string $id ,NotificationService $notifier)
    {
        Gate::authorize('parking_work.forceDelete');
         $parking_work=ParkingWork::withTrashed()->find($id)->forceDelete();
$notifier->trigger('parking_work', 'softDelete', $parking_work);
        return redirect()->route('Dashboard.parking_work.index');
    }
}
