<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\notification_rulesExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Notification_Rule;
use App\Models\Unit;
use App\Models\notification_rules;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class notification_ruleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('notification_rule.index');


        $page = 'index';
        $notification_rules = Notification_Rule::get();

        $unit = Unit::get();
        $building = Building::get();



        return view('Dashboard.Notification_Rule.index', compact('notification_rules', 'page', 'building', 'unit'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $notification_rules = Notification_Rule::search($request);
        $result = $notification_rules->get();
        $html = view('Dashboard.Notification_Rule.table', [
            'notification_rules' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $notification_rules = Notification_Rule::search($request);
        $result = $notification_rules->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'notification_rules' => $result];

        $pdf = Pdf::loadView('Dashboard.Notification_Rule.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('notification_rules.pdf');  // download
        // return $pdf->stream('notification_rules.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new Notification_RulesExport($request), 'notification_rules.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('notification_rule.create');
        $page = 'create';
        $notification_rule = new Notification_Rule();
        return view('Dashboard.Notification_Rule.create', compact('page', 'notification_rule'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('notification_rule.create');

     $data = $request->validate([
    'entity_type' => 'required|string',
    'event_type' => 'required|string',
    'target_audience' => 'required|in:all,admin,user,phone,email',
    'channels' => 'required|array|min:1',
    'message' => 'required|string',
]);

// handle optional fields
if ($request->target_audience === 'user') {
    $data['user_id'] = $request->validate(['user_id' => 'required|exists:users,id'])['user_id'];
} elseif ($request->target_audience === 'phone') {
    $data['phone'] = $request->validate(['phone' => 'required|string|max:20'])['phone'];
} elseif ($request->target_audience === 'email') {
    $data['email'] = $request->validate(['email' => 'required|email'])['email'];
}

$data['channels'] = json_encode($data['channels']);
$data['additional'] = json_encode($request->input('additional', []));
$data['actions'] = json_encode($request->input('actions', []));

Notification_Rule::create($data);
        return redirect()->route('Dashboard.notification_rule.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('notification_rule.restore');
        Notification_Rule::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.notification_rule.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('notification_rule.index');

        $notification_rules = Notification_Rule::onlyTrashed()->get();


        $unit = Unit::get();
        $building = Building::get();


        $page = 'trash';
        return view('Dashboard.Notification_Rule.index', compact('notification_rules', 'page',  'building', 'unit'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('notification_rule.update');

        $unit = Unit::get();
        $building = Building::get();


        $folder = 'notification_rules';
        $notification_rule = Notification_Rule::find($id);
        $page = 'edit';



        $folder = 'notification_rules';
        return view('Dashboard.Notification_Rule.edit', compact('page', 'notification_rule', 'folder', 'building', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('notification_rule.update');
        $data = $request->validate([
    'entity_type' => 'required|string',
    'event_type' => 'required|string',
    'target_audience' => 'required|in:all,admin,user,phone,email',
    'channels' => 'required|array|min:1',
    'message' => 'required|string',
]);

// handle optional fields
if ($request->target_audience === 'user') {
    $data['user_id'] = $request->validate(['user_id' => 'required|exists:users,id'])['user_id'];
} elseif ($request->target_audience === 'phone') {
    $data['phone'] = $request->validate(['phone' => 'required|string|max:20'])['phone'];
} elseif ($request->target_audience === 'email') {
    $data['email'] = $request->validate(['email' => 'required|email'])['email'];
}

$data['channels'] = json_encode($data['channels']);
$data['additional'] = json_encode($request->input('additional', []));
$data['actions'] = json_encode($request->input('actions', []));

        $notification_rules = Notification_Rule::find($id);



        $notification_rules->update($data);
        return redirect()->route('Dashboard.notification_rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('notification_rule.delete');
        Notification_Rule::find($id)->delete();
        return redirect()->route('Dashboard.notification_rule.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('notification_rule.forceDelete');
        Notification_Rule::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.notification_rule.index');
    }
}
