<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\GuestsExport;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Guest;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('guest.index');


        $page = 'index';
        $guest = Guest::get();


        return view('Dashboard.Guest.index', compact('guest', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;

        $guests = Guest::search($request);
        $result = $guests->get();
        $html = view('Dashboard.Guest.table', [
            'guest' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$guests=Guest::search($request);
$result=$guests->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'guests' => $result];

        $pdf = Pdf::loadView('Dashboard.Guest.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('guest.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new GuestsExport($request), 'guests.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('guest.create');
         $user = User::get();
         $page = 'create';
        $guest = new Guest();
        return view('Dashboard.Guest.create', compact('page', 'guest', 'user' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('guest.create');

     $request->validate([
        'name'=>['required','max:100'],
        'user'=>['required','exists:users,id'],
        'type'=>['required','max:100'],
        'login_time'=>['required','max:100'],
        'logout_time'=>['required','max:100'],
         'notes'=>['required','max:1000'],
        'login_date'=>'required|date|after_or_equal:today',
        'logout_date'=>'required|date|after_or_equal:login_date',
        ]);


$guest=Guest::create([
'name'=>$request->name,
'user_id'=>$request->user,
'type'=>$request->type,
'vehicle_number'=>$request->vehicle_number,
'login_time'=>$request->login_time,
'logout_time'=>$request->logout_time,
'notes'=>$request->notes,
'login_date'=>$request->login_date,
'logout_date'=>$request->logout_date,

]);
$notifier->trigger('guest', 'create', $guest);
        return redirect()->route('Dashboard.guest.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('guest.restore');
         $guest=Guest::withTrashed()->find($id)->restore();$notifier->trigger('guest', 'restore', $guest);
        return redirect()->route('Dashboard.guest.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('guest.index');

        $guest = Guest::onlyTrashed()->get();


        $page = 'trash';
        return view('Dashboard.Guest.index', compact('guest', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('guest.update');

         $user = User::get();

        $guest = Guest::find($id);
        $page = 'edit';
        return view('Dashboard.Guest.edit', compact('guest', 'page', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('guest.update');

   $request->validate([
        'name'=>['required','max:100'],
        'user'=>['required','exists:users,id'],
        'type'=>['required','max:100'],
        'login_time'=>['required','max:100'],
        'logout_time'=>['required','max:100'],
         'notes'=>['required','max:1000'],
        'login_date'=>'required|date|after_or_equal:today',
        'logout_date'=>'required|date|after_or_equal:login_date',
        ]);


           $guest= Guest::find($id);

        $guest->update([
'name'=>$request->name,
'user_id'=>$request->user,
'type'=>$request->type,
'vehicle_number'=>$request->vehicle_number,
'login_time'=>$request->login_time,
'logout_time'=>$request->logout_time,
'notes'=>$request->notes,
'login_date'=>$request->login_date,
'logout_date'=>$request->logout_date,

]);$notifier->trigger('guest', 'edit', $guest);
        return redirect()->route('Dashboard.guest.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('guest.delete');
        $guest=Guest::find($id)->delete(); $notifier->trigger('guest', 'delete', $guest);
        return redirect()->route('Dashboard.guest.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('guest.forceDelete');
        $guest=Guest::withTrashed()->find($id)->forceDelete();
$notifier->trigger('guest', 'softDelete', $guest);
        return redirect()->route('Dashboard.guest.index');
    }
}
