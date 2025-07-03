<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Target_Audience;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Target_AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('target_audience.index');
        $page = 'index';

        $target_audience = Target_Audience::get();
        return view('Dashboard.Target_Audience.index', compact('target_audience', 'page'));
    }


   public function search(Request $request,$id=null)
    {

        $user = Target_Audience::search($request);
        $result = $user->get();
    $target_audience=new Target_Audience();
        if($id !=null){
$target_audience=Target_Audience::find($id);
     }
        $html = view('Dashboard.Target_Audience.users', [
            'users' => $result,
            'target_audience' =>$target_audience
        ])->render();

        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('target_audience.create');
        $page = 'create';
        $users = User::get();
        $target_audience = new target_audience();
        return view('Dashboard.Target_Audience.create', compact('page', 'target_audience', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,NotificationService $notifier)
    {
        Gate::authorize('target_audience.create');
        $request->validate([
            'name' => 'required',
            'users'=>'required'
        ]);

       $target_audience = Target_Audience::create(['name' => $request->name,'users'=>json_encode($request->users)]);

        $notifier->trigger('target_audience', 'create', $target_audience);
        return redirect()->route('Dashboard.target_audience.index');
    }

    public function restore(string $id,NotificationService $notifier)
    {
        Gate::authorize('target_audience.restore');
        $target_audience= Target_Audience::withTrashed()->find($id)->restore();$notifier->trigger('target_audience', 'restore', $target_audience);
        return redirect()->route('Dashboard.target_audience.trash');
    }


    public function trash(Request $request)
    {
        Gate::authorize('target_audience.index');
        $target_audience = Target_Audience::onlyTrashed()->get();
        $page = 'trash';
        return view('Dashboard.Target_Audience.index', compact('target_audience', 'page'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('target_audience.update');
        $users = User::get();
        $target_audience = Target_Audience::find($id);
        $page = 'edit';
        return view('Dashboard.Target_Audience.edit', compact('target_audience', 'page', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,NotificationService $notifier)
    {
        Gate::authorize('target_audience.update');
        $request->validate([
  'users' => 'required',
            'name' => 'required',
        ]);
        $target_audience=Target_Audience::find($id)->update([
            'name' => $request->name,
            'users' => json_encode($request->users)
        ]);
        $target_audience = Target_Audience::find($id);
        $notifier->trigger('target_audience', 'edit', $target_audience);
        return redirect()->route('Dashboard.target_audience.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,NotificationService $notifier)
    {
        Gate::authorize('target_audience.delete');
        $target_audience=Target_Audience::find($id)->delete(); $notifier->trigger('target_audience', 'delete', $target_audience);
        return redirect()->route('Dashboard.target_audience.index');
    }

    public function delete(string $id,NotificationService $notifier)
    {
        Gate::authorize('target_audience.forceDelete');
        $target_audience=Target_Audience::withTrashed()->find($id)->forceDelete();
$notifier->trigger('target_audience', 'softDelete', $target_audience);
        return redirect()->route('Dashboard.target_audience.index');
    }
}
