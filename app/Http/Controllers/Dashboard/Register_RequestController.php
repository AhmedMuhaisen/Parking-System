<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\Register_RequestsExport;
use App\Http\Controllers\Controller;
use App\Mail\Register_RequestMail;
use App\Models\Building;
use App\Models\Register_Request;
use App\Models\Parking;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class Register_RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('register_request.index');

        $page = 'index';
        $register_request = Register_Request::get();
        return view('Dashboard.Register_Request.index', compact('page','register_request'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $register_requests = Register_Request::search($request);
        $result = $register_requests->get();
        $html = view('Dashboard.Register_Request.table', [
            'register_request' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $register_requests = Register_Request::search($request);
        $result = $register_requests->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'register_requests' => $result];

        $pdf = Pdf::loadView('Dashboard.Register_Request.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('register_request.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new Register_RequestsExport($request), 'register_requests.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('register_request.create');
        $page = 'create';
        $folder = '';

        $register_request = new Register_Request();
        return view('Dashboard.Register_Request.create', compact('page', 'register_request'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('register_request.create');
        $request->validate([
          'email'=>['required ',' email ','max:200',Rule::unique('users', 'email')]
        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('register_request', 'new');
        Register_Request::create([
            'email' => $request->email,

        ]);
        return redirect()->route('Dashboard.register_request.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('register_request.restore');
        Register_Request::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.register_request.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('register_request.index');
        $register_request = Register_Request::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Register_Request.index', compact('register_request', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function accept(string $id)
    {
        Gate::authorize('register_request.accept');
       $register=Register_Request::find($id);
        Mail::to($register->email)->send(new Register_RequestMail($register));
        $register->forceDelete();

        return redirect()->route('Dashboard.register_request.index');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     Gate::authorize('register_request.update');
    //     $request->validate([
    //          'name' => 'required',
    //          'user' => ['required','exists:users,id'],
    //         'building' => ['required','exists:buildings,id'],

    //          'parking' => ['required','exists:parkings,id'],
    //     ]);

    //     $register_request = Register_Request::find($id);

    //     $register_request->update([
    //    'name' => $request->name,

    //    'user_id' => $request->user,
    //         'building_id' => $request->building,

    //     ]);
    //     return redirect()->route('Dashboard.register_request.index');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('register_request.delete');
        Register_Request::find($id)->delete();
        return redirect()->route('Dashboard.register_request.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('register_request.forceDelete');
        Register_Request::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.register_request.index');
    }
}
