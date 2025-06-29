<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Building;

use App\Models\Unit;
use App\Models\User;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('user.index');


        $page = 'index';
        $user = User::get();

        $unit = Unit::get();
        $building = Building::get();



        return view('Dashboard.User.index', compact('user', 'page', 'building', 'unit'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $users = User::search($request);
        $result = $users->get();
        $html = view('Dashboard.User.table', [
            'user' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $users = User::search($request);
        $result = $users->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'users' => $result];

        $pdf = Pdf::loadView('Dashboard.User.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('user.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new UsersExport($request), 'users.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('user.create');

        $unit = Unit::get();
        $building = Building::get();


        $page = 'create';
        $folder = 'users';
        $user = new User();
        return view('Dashboard.User.create', compact('page', 'user', 'folder', 'building', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('user.create');

        $request->validate([
            'first_name'   => ['required', 'string', 'max:20'],
            'second_name'  => ['required', 'string', 'max:20'],
            'image'        => ['required', 'image', 'mimes:jpeg,jpg,png,svg,webp', 'max:3048'],
            'date_birth'   => ['required', 'date', 'before:today'],
            'phone'        => [
                'required',
                'string',
                'min:10',
                'max:15',
                Rule::unique('users', 'phone')
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'building'  => ['required', 'exists:buildings,id'],
            'unit'      => ['required', 'exists:units,id'],
            'type' => ['required', 'string'],
            'verified' => ['required', 'date'],
        ]);

        $image = $request->image;
        $image = $image->storePublicly('user', 'new');


        $user=User::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'image' => $image,
            'phone' => $request->phone,
            'email' => $request->email,
            'building_id' => $request->building,
            'unit_id' => $request->unit,
            'type' => $request->type,
            'date_birth' => $request->date_birth,
            'email_verified_at' => $request->verified,

        ]);$notifier->trigger('user', 'create', $user);
        return redirect()->route('Dashboard.user.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('user.restore');
        $user= User::withTrashed()->find($id)->restore();$notifier->trigger('user', 'restore', $user);
        return redirect()->route('Dashboard.user.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('user.index');

        $user = User::onlyTrashed()->get();


        $unit = Unit::get();
        $building = Building::get();


        $page = 'trash';
        return view('Dashboard.User.index', compact('user', 'page',  'building', 'unit'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('user.update');

        $unit = Unit::get();
        $building = Building::get();


        $folder = 'users';
        $user = User::find($id);
        $page = 'edit';



        $folder = 'users';
        return view('Dashboard.User.edit', compact('page', 'user', 'folder', 'building', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('user.update');
        $request->validate([
            'first_name'   => ['required', 'string', 'max:20'],
            'second_name'  => ['required', 'string', 'max:20'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg,webp', 'max:3048'],
            'date_birth'   => ['required', 'date', 'before:today'],
            'phone'        => [
                'required',
                'string',
                'min:10',
                'max:15',
                Rule::unique('users', 'phone')->ignore($id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id)
            ],
            'building'  => ['required', 'exists:buildings,id'],
            'unit'      => ['required', 'exists:units,id'],
            'type' => ['required', 'string'],
            'verified' => ['required', 'date'],
        ]);
        $user= User::find($id);

        if ($request->image) {
            $image = $request->image;
            $image = $image->storePublicly('user', 'new');
        } else {
            $image = $user->image;
        }

        $user->update([
           'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'image' => $image,
            'phone' => $request->phone,
            'email' => $request->email,
            'building_id' => $request->building,
            'unit_id' => $request->unit,
            'type' => $request->type,
            'date_birth' => $request->date_birth,
            'email_verified_at' => $request->verified,

        ]);$notifier->trigger('user', 'edit', $user);
        return redirect()->route('Dashboard.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('user.delete');
       $user= User::find($id)->delete(); $notifier->trigger('user', 'delete', $user);
        return redirect()->route('Dashboard.user.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('user.forceDelete');
        $user=User::withTrashed()->find($id)->forceDelete();
$notifier->trigger('user', 'softDelete', $user);
        return redirect()->route('Dashboard.user.index');
    }
}
