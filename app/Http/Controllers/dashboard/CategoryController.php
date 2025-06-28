<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CategoriesExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('category.index');


        $page = 'index';
        $category = Category::get();
        return view('Dashboard.Category.index', compact('category', 'page'));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $categories = Category::search($request);
        $result = $categories->get();
        $html = view('Dashboard.Category.table', [
            'category' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$categories=Category::search($request);
$result=$categories->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'categories' => $result];

        $pdf = Pdf::loadView('Dashboard.Category.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('a4', 'landscape');

        return $pdf->download('category.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new CategoriesExport($request), 'categories.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('category.create');
        $page = 'create';
        $folder = '';
        $category = new Category();
        return view('Dashboard.Category.create', compact('page', 'category', 'folder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,NotificationService $notifier)
    {
        Gate::authorize('category.create');
      $request->validate([
            'name' => 'required',
           'work_method'=>'required',
           'status'=>'required',
           'description'=>'required',

        ]);
        // $image = $request->image;
        // $image = $image->storePublicly('category', 'new');
          $category= Category::create([
           'name' => $request->name,
            'work_method' => $request->work_method,
            'status' => $request->status,
            'description' => $request->description

        ]);

         $notifier->trigger('category', 'create', $category);
        return redirect()->route('Dashboard.category.index');
    }

    public function restore(string $id ,NotificationService $notifier)
    {
        Gate::authorize('category.restore');
        $category=  Category::withTrashed()->find($id)->restore();  $notifier->trigger('category', 'restore', $category);
        return redirect()->route('Dashboard.category.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('category.index');
        $category = Category::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Category.index', compact('category', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('category.update');
        $folder = 'category';
        $category = Category::find($id);
        $page = 'edit';
        return view('Dashboard.Category.edit', compact('category', 'page', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id ,NotificationService $notifier)
    {
        Gate::authorize('category.update');
        $request->validate([
            'name' => 'required',
           'work_method'=>'required',
           'status'=>'required',
           'description'=>'required',

        ]);

        $category = Category::find($id);

        $category->update([
            'name' => $request->name,
            'work_method' => $request->work_method,
            'status' => $request->status,
            'description' => $request->description,
        ]);
        $notifier->trigger('category', 'edit', $category);
        return redirect()->route('Dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id ,NotificationService $notifier)
    {
        Gate::authorize('category.delete');
         $category=Category::find($id)->delete();
         $notifier->trigger('category', 'delete', $category);
        return redirect()->route('Dashboard.category.index');
    }

    public function delete(string $id ,NotificationService $notifier)
    {
        Gate::authorize('category.forceDelete');
         $category=Category::withTrashed()->find($id)->forceDelete();
$notifier->trigger('category', 'softDelete', $category);
        return redirect()->route('Dashboard.category.index');
    }
}
