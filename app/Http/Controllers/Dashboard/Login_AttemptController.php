<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\Login_AttemptsExport;
use App\Http\Controllers\Controller;
use App\Models\Gate as GateModel;
use App\Models\Login_Attempt;
use App\Models\Parking;
use App\Models\User;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class Login_AttemptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('login_attempt.index');
        $page = 'index';
        $login_attempt = Login_Attempt::with([
            'gate',
        ])->get();;
        $gates = GateModel::get();
        return view('Dashboard.Login_Attempt.index', compact('login_attempt', 'page', 'gates'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $login_attempts = Login_Attempt::search($request);
        $result = $login_attempts->get();
        $html = view('Dashboard.Login_Attempt.table', [
            'login_attempt' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $login_attempts = Login_Attempt::search($request);
        $result = $login_attempts->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'login_attempts' => $result];

        $pdf = Pdf::loadView('Dashboard.Login_Attempt.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('login_attempt.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {

        return Excel::download(new Login_AttemptsExport($request), 'login_attempts.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('login_attempt.create');
        $page = 'create';
        $gates = GateModel::get();
        $login_attempt = new Login_Attempt();
        return view('Dashboard.Login_Attempt.create', compact('page', 'login_attempt', 'gates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('login_attempt.create');
        $request->validate([
            'vehicle_number' => 'required',
            'gate' => ['required', 'exists:gates,id'],

        ]);
        $login_attempt=Login_Attempt::create([
            'vehicle_number' => $request->vehicle_number,
            'gate_id' => $request->gate,

        ]);$notifier->trigger('login_attempt', 'create', $login_attempt);
        return redirect()->route('Dashboard.login_attempt.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('login_attempt.restore');
         $login_attempt=Login_Attempt::withTrashed()->find($id)->restore();$notifier->trigger('login_attempt', 'restore', $login_attempt);
        return redirect()->route('Dashboard.login_attempt.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('login_attempt.index');
        $login_attempt = Login_Attempt::onlyTrashed()->get();
        $page = 'trash';
        $gates = GateModel::get();
        return view('Dashboard.Login_Attempt.index', compact('login_attempt', 'page', 'gates'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('login_attempt.update');

        $login_attempt = Login_Attempt::find($id);
        $page = 'edit';
        $gates = GateModel::get();


        return view('Dashboard.Login_Attempt.edit', compact('page', 'login_attempt', 'gates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('login_attempt.update');
        $request->validate([
               'vehicle_number' => 'required',
            'gate' => ['required', 'exists:gates,id'],
        ]);

       $login_attempt= Login_Attempt::find($id);

        $login_attempt->update([
             'vehicle_number' => $request->vehicle_number,
            'gate_id' => $request->gate,
        ]);$notifier->trigger('login_attempt', 'edit', $login_attempt);
        return redirect()->route('Dashboard.login_attempt.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('login_attempt.delete');
        $login_attempt=Login_Attempt::find($id)->delete(); $notifier->trigger('login_attempt', 'delete', $login_attempt);
        return redirect()->route('Dashboard.login_attempt.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('login_attempt.forceDelete');
        $login_attempt=Login_Attempt::withTrashed()->find($id)->forceDelete();
$notifier->trigger('login_attempt', 'softDelete', $login_attempt);
        return redirect()->route('Dashboard.login_attempt.index');
    }
}
