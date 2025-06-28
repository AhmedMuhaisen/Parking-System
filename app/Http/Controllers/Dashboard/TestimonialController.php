<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\TestimonialsExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Testimonial;
use App\Models\Parking;
use App\Models\User;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('testimonial.index');
        $page = 'index';
        $testimonial = Testimonial::with([
            'user',
        ])->get();

        return view('Dashboard.Testimonial.index', compact('testimonial', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $testimonials = Testimonial::search($request);
        $result = $testimonials->get();
        $html = view('Dashboard.Testimonial.table', [
            'testimonial' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
        $testimonials = Testimonial::search($request);
        $result = $testimonials->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'testimonials' => $result];

        $pdf = Pdf::loadView('Dashboard.Testimonial.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('testimonial.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {

        return Excel::download(new TestimonialsExport($request), 'testimonials.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('testimonial.create');
        $page = 'create';
        $users = User::get();
        $testimonial = new Testimonial();
        return view('Dashboard.Testimonial.create', compact('page', 'testimonial', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('testimonial.create');
        $request->validate([
       'rating' => 'required|numeric|min:1|max:5',
        'text'=> 'required|string|max:1000',
        'user'=> 'required|exists:users,id',
        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('testimonial', 'new');
        $testimonial=Testimonial::create([
            'rating' => $request->rating,
            'text' => $request->text,
            'user_id' => $request->user,
        ]);$notifier->trigger('testimonial', 'create', $testimonial);
        return redirect()->route('Dashboard.testimonial.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('testimonial.restore');
        $testimonial= Testimonial::withTrashed()->find($id)->restore();$notifier->trigger('testimonial', 'restore', $testimonial);
        return redirect()->route('Dashboard.testimonial.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('testimonial.index');
        $testimonial = Testimonial::onlyTrashed()->get();
        $page = 'trash';

        return view('Dashboard.Testimonial.index', compact('testimonial', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('testimonial.update');

        $testimonial = Testimonial::find($id);
        $page = 'edit';

        $users = User::get();
        return view('Dashboard.Testimonial.edit', compact('page', 'testimonial','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('testimonial.update');
        $request->validate([
                 'rating' => 'required|numeric|min:1|max:5',
    'text'=> 'required|string|max:1000',
    'user'=> 'required|exists:users,id',
        ]);

        $testimonial= Testimonial::find($id);

        $testimonial->update([
           'rating' => $request->rating,
            'text' => $request->text,
            'user_id' => $request->user,

        ]);$notifier->trigger('testimonial', 'edit', $testimonial);
        return redirect()->route('Dashboard.testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('testimonial.delete');
        $testimonial=Testimonial::find($id)->delete(); $notifier->trigger('testimonial', 'delete', $testimonial);
        return redirect()->route('Dashboard.testimonial.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('testimonial.forceDelete');
       $testimonial= Testimonial::withTrashed()->find($id)->forceDelete();
$notifier->trigger('testimonial', 'softDelete', $testimonial);
        return redirect()->route('Dashboard.testimonial.index');
    }
}
