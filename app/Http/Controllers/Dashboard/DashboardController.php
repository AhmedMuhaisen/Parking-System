<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Camera;
use App\Models\Gate;
use App\Models\Message;
use App\Models\Notification_System;
use App\Models\Vehicle;
use App\Models\VehiclesMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        $vehicle_movement= VehiclesMovement::query();

$startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
$endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY);

// Query: count vehicles grouped by day of week (0=Sunday, 1=Monday,...6=Saturday)
$counts = VehiclesMovement::select(DB::raw('DAYOFWEEK(created_at) - 1 as day'), DB::raw('count(*) as total'))
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->groupBy('day')
    ->pluck('total', 'day');

// Build chart data in order of $chartLabels
$chartData = [];

foreach (range(0, 6) as $dayIndex) {
    $chartData[] = $counts->get($dayIndex, 0);
}




            return view('Dashboard.index', [

    'todayMovements' => $vehicle_movement->count(),
    'latestVehicles' => Vehicle::latest()->take(5)->get(),
    'chartLabels' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    'chartData' => $chartData,
    'notifications' => Notification_System::where('id', Auth::id())->where('is_read', 0)->get(),
    'recentEntries' => $vehicle_movement->latest()->take(5)->get(),
   'entryCount' => (clone $vehicle_movement)->where('type_Movement', 'Entry')->count(),
    'exitCount'  => (clone $vehicle_movement)->where('type_Movement', 'Exit')->count(),
    ]);
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
