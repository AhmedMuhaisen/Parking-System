<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\MessagesExport;
use App\Http\Controllers\Controller;
use App\Mail\Send_messageMail;
use App\Models\Gate as GateModel;
use App\Models\Message;
use App\Models\Parking;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
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
    public function create()
    {
        Gate::authorize('message.create');
        $page = 'create';
        $users=User::get();
        $message = new message();
        return view('Dashboard.Message.create', compact('page', 'message','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('message.create');
          $rules = [
        'send_type' => 'required|in:user,email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    // Conditional validation
    if ($request->send_type === 'email') {
        $rules['email'] = 'required|email';
        $email=$request->email;
    } elseif ($request->send_type === 'user') {
        $rules['user_id'] = 'required|exists:users,id';
        $email=$request->user_id;
    }
        $data = [
            'email' => $email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to($request->email)->send(new Send_messageMail($data));

        Message::create([
            'email' => $email,
            'type' => 'Incoming',
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return redirect()->route('Dashboard.message.index');
    }

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
    public function edit(string $id)
    {
        Gate::authorize('message.reply');
       $page = 'edit';
        $users=User::get();
        $message = Message::find($id);
        return view('Dashboard.Message.edit', compact('page', 'message','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('message.reply');
        $request->validate([
        'email' => 'required',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        ]);


  $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('ahmedmuhisan6@gmail.com')->send(new Send_messageMail($data));

        Message::create([
            'email' => $request->email,
            'type' => 'outgoing',
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return redirect()->route('Dashboard.message.index');
    }

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
