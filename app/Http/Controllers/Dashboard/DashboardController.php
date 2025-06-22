<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        return view('Dashboard.index');
    }

    function contact()
    {
        $message = Message::get();
        return view('Dashboard.contact', compact('message'));
    }

    function destroy(string $id)
    {
        Message::find($id)->delete();
        return redirect()->route('Dashboard.contact');
    }
}
