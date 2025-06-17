<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\VehiclesExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Category;
use App\Models\MotorType;
use App\Models\Unit;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehiclesBrand;
use App\Models\VehiclesType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('vehicle.index');


        $page = 'index';
        $vehicle = Vehicle::get();
        $category = Category::get();
        $vehicle_type = VehiclesType::get();
        $vehicle_brand = VehiclesBrand::get();
         $unit = Unit::get();
        $building = Building::get();

        $motor_type = MotorType::get();


        return view('Dashboard.Vehicle.index', compact('vehicle', 'page','category'  ,'vehicle_type'   ,'vehicle_brand'  ,'motor_type','building','unit'   ));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $vehicles = Vehicle::search($request);
        $result = $vehicles->get();
        $html = view('Dashboard.Vehicle.table', [
            'vehicle' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$vehicles=Vehicle::search($request);
$result=$vehicles->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'vehicles' => $result];

        $pdf = Pdf::loadView('Dashboard.Vehicle.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('vehicle.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new VehiclesExport($request), 'vehicles.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('vehicle.create');
           $category = Category::get();
        $vehicle_type = VehiclesType::get();
        $vehicle_brand = VehiclesBrand::get();
         $unit = Unit::get();
        $building = Building::get();
         $motor_type = MotorType::get();
         $user = User::get();
         $page = 'create';
        $folder = '';
        $vehicle = new Vehicle();
        return view('Dashboard.Vehicle.create', compact('page', 'vehicle', 'folder','category'  ,'vehicle_type' ,'user'  ,'vehicle_brand'  ,'motor_type','building','unit' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('vehicle.create');
      $request->validate([
        'vehicle_number'=>['required','digits:6'],
        'color'=>['required','max:10'],
        'image'=>['required','image','mimes:jpeg,jpg,png,svg|max:2048'],
        'category'=>['required','exists:Categories,id'],
        'vehicle_type'=>['required','exists:vehicles_types,id'],
        'vehicle_brand'=>['required','exists:vehicles_brands,id'],
        'motor_type'=>['required','exists:motor_types,id'],
        'user'=>['required','exists:users,id'],
        'date_start'=>'required|date|after_or_equal:today',
        'date_end'=>'required|date|max:40|after_or_equal:date_start',
        ]);

            $image = $request->image;
            $image = $image->storePublicly('vehicle', 'new');


        Vehicle::create([
            'vehicle_number'=>$request->vehicle_number,
            'color'=>$request->color,
            'image'=>$image,
            'category_id'=>$request->category,
            'vehicles_type_id'=>$request->vehicle_type,
            'vehicles_brand_id'=>$request->vehicle_brand,
            'motor_type_id'=>$request->motor_type,
            'user_id'=>$request->user,
            'date_start'=>$request->date_start,
            'date_End'=>$request->date_end,
        ]);
        return redirect()->route('Dashboard.vehicle.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('vehicle.restore');
        Vehicle::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.vehicle.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('vehicle.index');

        $vehicle = Vehicle::onlyTrashed()->get();

        $category = Category::get();
        $vehicle_type = VehiclesType::get();
        $vehicle_brand = VehiclesBrand::get();
         $unit = Unit::get();
        $building = Building::get();

        $motor_type = MotorType::get();
        $page = 'trash';
        return view('Dashboard.Vehicle.index', compact('vehicle', 'page','category'  ,'vehicle_type'   ,'vehicle_brand'  ,'motor_type','building','unit'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('vehicle.update');
               $category = Category::get();
        $vehicle_type = VehiclesType::get();
        $vehicle_brand = VehiclesBrand::get();
         $unit = Unit::get();
        $building = Building::get();
         $motor_type = MotorType::get();
         $user = User::get();
        $folder = 'vehicle';
        $vehicle = Vehicle::find($id);
        $page = 'edit';
        return view('Dashboard.Vehicle.edit', compact('vehicle', 'page', 'folder','category'  ,'vehicle_type' ,'user'  ,'vehicle_brand'  ,'motor_type','building','unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('vehicle.update');
              $request->validate([
        'vehicle_number'=>['required','min:5','max:12'],
        'color'=>['required','max:10'],
        'image'=>['nullable','image','mimes:jpeg,jpg,png,svg|max:2048'],
        'category'=>['required','exists:Categories,id'],
        'vehicle_type'=>['required','exists:vehicles_types,id'],
        'vehicle_brand'=>['required','exists:vehicles_brands,id'],
        'motor_type'=>['required','exists:motor_types,id'],
        'user'=>['required','exists:users,id'],
        'date_start'=>'required|date|after_or_equal:today',
        'date_end'=>'required|date|max:40|after_or_equal:date_start',
        ]);
           $vehicle = Vehicle::find($id);

if($request->image){
   $image = $request->image;
            $image = $image->storePublicly('vehicle', 'new');

            }
            else{
                $image=$vehicle->image;
            }

        $vehicle->update([
            'vehicle_number'=>$request->vehicle_number,
            'color'=>$request->color,
            'image'=>$image,
            'category_id'=>$request->category,
            'vehicles_type_id'=>$request->vehicle_type,
            'vehicles_brand_id'=>$request->vehicle_brand,
            'motor_type_id'=>$request->motor_type,
            'user_id'=>$request->user,
            'date_start'=>$request->date_start,
            'date_End'=>$request->date_end,
        ]);
        return redirect()->route('Dashboard.vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('vehicle.delete');
        Vehicle::find($id)->delete();
        return redirect()->route('Dashboard.vehicle.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('vehicle.forcedelete');
        Vehicle::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.vehicle.index');
    }
}
