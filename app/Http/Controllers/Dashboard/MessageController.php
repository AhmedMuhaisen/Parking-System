<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\MessagesExport;
use App\Http\Controllers\Controller;
use App\Models\Gate as GateModel;
use App\Models\Message;
use App\Models\Parking;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('message.index');


        $page = 'index';
        $message = Message::get();

        return view('Dashboard.Message.index', compact('message', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $messages = Message::search($request);
        $result = $messages->get();
        $html = view('Dashboard.Message.table', [
            'message' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $messages = Message::search($request);
        $result = $messages->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'messages' => $result];

        $pdf = Pdf::loadView('Dashboard.Message.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('message.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {

        return Excel::download(new MessagesExport($request), 'messages.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     Gate::authorize('message.create');
    //     $page = 'create';
    //     $folder = '';
    //     $parkings = Parking::get();
    //     $gates = GateModel::get();
    //     $message = new message();
    //     return view('Dashboard.Message.create', compact('page', 'message', 'parkings' , 'gates'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     Gate::authorize('message.create');
    //     $request->validate([
    //         'name' => 'required',
    //         'gate' => ['required','exists:gates,id'],

    //     ]);
    //     // $image = $request->image;
    //     // $image = $image->storePublicly('message', 'new');
    //     Message::create([
    //         'name' => $request->name,
    //         'gate_id' => $request->gate,

    //     ]);
    //     return redirect()->route('Dashboard.message.index');
    // }

    public function restore(string $id)
    {
        Gate::authorize('message.restore');
        Message::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.message.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('message.index');
        $message = Message::onlyTrashed()->get();
        $page = 'trash';

        return view('Dashboard.Message.index', compact('message', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
//     public function edit(string $id)
//     {
//         Gate::authorize('message.update');

//         $message = Message::find($id);
//         $page = 'edit';
// $parkings=Parking::get();
// $gates=GateModel::get();


//         return view('Dashboard.Message.edit', compact('page', 'message','parkings' ,'gates'));
//     }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     Gate::authorize('message.update');
    //     $request->validate([
    //          'name' => 'required',
    //          'user' => ['required','exists:users,id'],
    //         'gate' => ['required','exists:gates,id'],

    //          'parking' => ['required','exists:parkings,id'],
    //     ]);

    //     $message = Message::find($id);

    //     $message->update([
    //    'name' => $request->name,

    //    'user_id' => $request->user,
    //         'gate_id' => $request->gate,

    //     ]);
    //     return redirect()->route('Dashboard.message.index');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('message.delete');
        Message::find($id)->delete();
        return redirect()->route('Dashboard.message.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('message.forceDelete');
        Message::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.message.index');
    }
}
