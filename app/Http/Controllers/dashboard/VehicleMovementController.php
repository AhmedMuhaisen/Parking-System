<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\VehicleMovementsExport;
use App\Exports\VehiclesMovementExport;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Category;
use App\Models\Gate as ModelsGate;
use App\Models\MotorType;

use App\Models\User;
use App\Models\VehicleMovement;
use App\Models\VehiclesMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class VehicleMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('vehiclesMovement.index');


        $page = 'index';
        $vehicleMovement = VehiclesMovement::get();
        $gate = ModelsGate::get();


        return view('Dashboard.VehicleMovement.index', compact('vehicleMovement', 'page' ,'gate'  ));
    }

    public function search(Request $request)
    {
        $page = $request->page;
        $vehicleMovements = VehiclesMovement::search($request);
        $result = $vehicleMovements->get();
        $html = view('Dashboard.VehicleMovement.table', [
            'vehicleMovement' => $result,
            'page' => $page,
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function exportPDF(Request $request)
    {
$vehicleMovements=VehiclesMovement::search($request);
$result=$vehicleMovements->get();
        $data = ['title' => 'My PDF Report', 'page' => 'index', 'vehicleMovements' => $result];

        $pdf = Pdf::loadView('Dashboard.VehicleMovement.export-pdf', $data)->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('tabloid', 'landscape');

        return $pdf->download('vehicleMovement.pdf');  // download
        // return $pdf->stream('users.pdf'); // OR show in browser
    }



    public function exportExcel(Request $request)
    {
        return Excel::download(new VehiclesMovementExport($request), 'vehicleMovements.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('vehicleMovement.create');
           $category = Category::get();

        $building = Building::get();
         $motor_type = MotorType::get();
         $user = User::get();
         $page = 'create';
        $folder = '';
        $vehicleMovement = new VehiclesMovement();
        return view('Dashboard.VehicleMovement.create', compact('page', 'vehicleMovement', 'folder','category'  ,'vehicleMovement_type' ,'user'  ,'vehicleMovement_brand'  ,'motor_type','building','unit' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('vehicleMovement.create');
      $request->validate([
        'vehicleMovement_number'=>['required','digits:6'],
        'color'=>['required','max:10'],
        'image'=>['required','image','mimes:jpeg,jpg,png,svg|max:2048'],
        'category'=>['required','exists:Categories,id'],
        'vehicleMovement_type'=>['required','exists:vehicleMovements_types,id'],
        'vehicleMovement_brand'=>['required','exists:vehicleMovements_brands,id'],
        'motor_type'=>['required','exists:motor_types,id'],
        'user'=>['required','exists:users,id'],
        'date_start'=>'required|date|after_or_equal:today',
        'date_end'=>'required|date|max:40|after_or_equal:date_start',
        ]);

            $image = $request->image;
            $image = $image->storePublicly('vehicleMovement', 'new');


        VehiclesMovement::create([
            'vehicleMovement_number'=>$request->vehicleMovement_number,
            'color'=>$request->color,
            'image'=>$image,
            'category_id'=>$request->category,
            'vehicleMovements_type_id'=>$request->vehicleMovement_type,
            'vehicleMovements_brand_id'=>$request->vehicleMovement_brand,
            'motor_type_id'=>$request->motor_type,
            'user_id'=>$request->user,
            'date_start'=>$request->date_start,
            'date_End'=>$request->date_end,
        ]);
        return redirect()->route('Dashboard.vehicleMovement.index');
    }

    public function restore(string $id)
    {
        Gate::authorize('vehicleMovement.restore');
        VehiclesMovement::withTrashed()->find($id)->restore();
        return redirect()->route('Dashboard.vehicleMovement.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('vehicleMovement.index');

        $vehicleMovement = VehiclesMovement::onlyTrashed()->get();

        $category = Category::get();

        $building = Building::get();

        $motor_type = MotorType::get();
        $page = 'trash';
        return view('Dashboard.VehicleMovement.index', compact('vehicleMovement', 'page','category'  ,'vehicleMovement_type'   ,'vehicleMovement_brand'  ,'motor_type','building','unit'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('vehicleMovement.update');
               $category = Category::get();

        $building = Building::get();
         $motor_type = MotorType::get();
         $user = User::get();
        $folder = 'vehicleMovement';
        $vehicleMovement = VehiclesMovement::find($id);
        $page = 'edit';
        return view('Dashboard.VehicleMovement.edit', compact('vehicleMovement', 'page', 'folder','category'  ,'vehicleMovement_type' ,'user'  ,'vehicleMovement_brand'  ,'motor_type','building','unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('vehicleMovement.update');
              $request->validate([
        'vehicleMovement_number'=>['required','min:5','max:12'],
        'color'=>['required','max:10'],
        'image'=>['nullable','image','mimes:jpeg,jpg,png,svg|max:2048'],
        'category'=>['required','exists:Categories,id'],
        'vehicleMovement_type'=>['required','exists:vehicleMovements_types,id'],
        'vehicleMovement_brand'=>['required','exists:vehicleMovements_brands,id'],
        'motor_type'=>['required','exists:motor_types,id'],
        'user'=>['required','exists:users,id'],
        'date_start'=>'required|date|after_or_equal:today',
        'date_end'=>'required|date|max:40|after_or_equal:date_start',
        ]);
           $vehicleMovement = VehiclesMovement::find($id);

if($request->image){
   $image = $request->image;
            $image = $image->storePublicly('vehicleMovement', 'new');

            }
            else{
                $image=$vehicleMovement->image;
            }

        $vehicleMovement->update([
            'vehicleMovement_number'=>$request->vehicleMovement_number,
            'color'=>$request->color,
            'image'=>$image,
            'category_id'=>$request->category,
            'vehicleMovements_type_id'=>$request->vehicleMovement_type,
            'vehicleMovements_brand_id'=>$request->vehicleMovement_brand,
            'motor_type_id'=>$request->motor_type,
            'user_id'=>$request->user,
            'date_start'=>$request->date_start,
            'date_End'=>$request->date_end,
        ]);
        return redirect()->route('Dashboard.vehicleMovement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('vehicleMovement.delete');
        VehiclesMovement::find($id)->delete();
        return redirect()->route('Dashboard.vehicleMovement.index');
    }

    public function delete(string $id)
    {
        Gate::authorize('vehicleMovement.forcedelete');
        VehiclesMovement::withTrashed()->find($id)->forceDelete();

        return redirect()->route('Dashboard.vehicleMovement.index');
    }
}
