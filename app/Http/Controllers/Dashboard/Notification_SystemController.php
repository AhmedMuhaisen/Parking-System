<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\notification_SystemsExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Notification_System;
use App\Models\Unit;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\system;
use Maatwebsite\Excel\Facades\Excel;

class notification_SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('notification_system.index');


        $page = 'index';
      $notification_systems = Notification_System::where('user_id', Auth::id())->paginate(10);

foreach($notification_systems as $item){
$item->update(['is_read'=>1]);
}




        return view('Dashboard.Notification_System.index', compact('notification_systems', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $notification_systems = Notification_System::search($request);
        $result = $notification_systems->get();
        $html = view('Dashboard.Notification_System.table', [
            'notification_systems' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $notification_systems = Notification_System::search($request);
        $result = $notification_systems->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'notification_systems' => $result];

        $pdf = Pdf::loadView('Dashboard.Notification_System.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('notification_systems.pdf');  // download
        // return $pdf->stream('notification_systems.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new Notification_systemsExport($request), 'notification_systems.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     Gate::authorize('notification_system.create');
    //     $page = 'create';
    //     $notification_system = new Notification_system();
    //     return view('Dashboard.Notification_System.create', compact('page', 'notification_system'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request, NotificationService $notifier)
    // {
    //     Gate::authorize('notification_system.create');

    //     $data = $request->validate([
    //         'entity_type' => 'required|string',
    //         'event_type' => 'required|string',
    //         'target_audience' => 'required|in:all,admin,user,phone,email',
    //         'channels' => 'required|array|min:1',
    //         'message' => 'required|string',

    //     ]);

    //     // handle optional fields
    //     if ($request->target_audience === 'user') {
    //         $data['user_id'] = $request->validate(['user_id' => 'required|exists:users,id'])['user_id'];
    //     } elseif ($request->target_audience === 'phone') {
    //         $data['phone'] = $request->validate(['phone' => 'required|string|max:20'])['phone'];
    //     } elseif ($request->target_audience === 'email') {
    //         $data['email'] = $request->validate(['email' => 'required|email'])['email'];
    //     }

    //     $data['channels'] = json_encode($data['channels']);
    //     $data['additional'] = json_encode($request->input('additional', []));
    //     $data['actions'] = json_encode($request->input('actions', []));
    //     if ($request->onr) {
    //         $data['onr'] = 'true';
    //     } else {
    //         $data['onr'] = 'false';
    //     }

    //     $notification_system = Notification_System::create($data);
    //     $notifier->trigger('notification_system', 'create', $notification_system);
    //     return redirect()->route('Dashboard.notification_system.index');
    // }

    // public function restore(string $id, NotificationService $notifier)
    // {
    //     Gate::authorize('notification_system.restore');
    //     $notification_system = Notification_System::withTrashed()->find($id)->restore();
    //     $notifier->trigger('notification_system', 'restore', $notification_system);
    //     return redirect()->route('Dashboard.notification_system.trash');
    // }


    // public function trash(Request $request)
    // {
    //     Gate::authorize('notification_system.index');

    //     $notification_systems = Notification_System::onlyTrashed()->get();


    //     $unit = Unit::get();
    //     $building = Building::get();


    //     $page = 'trash';
    //     return view('Dashboard.Notification_System.index', compact('notification_systems', 'page',  'building', 'unit'));
    // }
    // /**
    //  * Display the specified resource.
    //  */

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     Gate::authorize('notification_system.update');

    //     $unit = Unit::get();
    //     $building = Building::get();


    //     $folder = 'notification_systems';
    //     $notification_system = Notification_System::find($id);
    //     $page = 'edit';



    //     $folder = 'notification_systems';
    //     return view('Dashboard.Notification_System.edit', compact('page', 'notification_system', 'folder', 'building', 'unit'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id, NotificationService $notifier)
    // {
    //     Gate::authorize('notification_system.update');
    //     $data = $request->validate([
    //         'entity_type' => 'required|string',
    //         'event_type' => 'required|string',
    //         'target_audience' => 'required|in:all,admin,user,phone,email',
    //         'channels' => 'required|array|min:1',
    //         'message' => 'required|string',
    //     ]);

    //     // handle optional fields
    //     if ($request->target_audience === 'user') {
    //         $data['user_id'] = $request->validate(['user_id' => 'required|exists:users,id'])['user_id'];
    //     } elseif ($request->target_audience === 'phone') {
    //         $data['phone'] = $request->validate(['phone' => 'required|string|max:20'])['phone'];
    //     } elseif ($request->target_audience === 'email') {
    //         $data['email'] = $request->validate(['email' => 'required|email'])['email'];
    //     }

    //     $data['channels'] = json_encode($data['channels']);
    //     $data['additional'] = json_encode($request->input('additional', []));
    //     $data['actions'] = json_encode($request->input('actions', []));
    //     if ($request->onr) {
    //         $data['onr'] = 'true';
    //     } else {
    //         $data['onr'] = 'false';
    //     }
    //     $notification_system = Notification_System::find($id);



    //     $notification_system->update($data);
    //     $notifier->trigger('notification_system', 'edit', $notification_system);
    //     return redirect()->route('Dashboard.notification_system.index');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id, NotificationService $notifier)
    // {
    //     Gate::authorize('notification_system.delete');
    //     $notification_system = Notification_System::find($id)->delete();
    //     $notifier->trigger('notification_system', 'delete', $notification_system);
    //     return redirect()->route('Dashboard.notification_system.index');
    // }

    // public function delete(string $id, NotificationService $notifier)
    // {
    //     Gate::authorize('notification_system.forceDelete');
    //     $notification_system = Notification_System::withTrashed()->find($id)->forceDelete();
    //     $notifier->trigger('notification_system', 'softDelete', $notification_system);
    //     return redirect()->route('Dashboard.notification_system.index');
    // }
}
