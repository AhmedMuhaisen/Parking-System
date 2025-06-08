<?php
 namespace App\Http\Controllers;

use App\Mail\reset_passwordMail;
use App\Mail\Send_messageMail;
use App\Models\Building;
use App\Models\VehiclesBrand;
use App\Models\Guest;
use App\Models\MotorType;



use App\Models\Unit;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehiclesType;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;
use PHPUnit\TextUI\XmlConfiguration\Logging\Logging;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

class AuthController extends Controller
{


 function login()
    {

        return view('auth.login');
    }

 function login_post(Request $request)
    {
        $credentials = $request->validate([
               'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'exists:users,email'
    ],
    'password' => [
        'required',
        'string',
        'min:8'
    ],

        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/website'); // Change to your route
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    function reset_password()
    {
        return view('auth.resit_password');
    }


    function reset_password_post(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:users,email']
        ]);
        $user = User::where('email', $request->email)->first();
        $data = [
            'email' => $request->email,
            'subject' => 'create new password',
            'id' => $user->id,
        ];

        Mail::to($request->email)->send(new reset_passwordMail($data));


        $meassege = "success";
        return redirect('login')->with('msg', $meassege);
    }

    function create_new_password($id)
    {

        return view('auth.create_new_password', compact('id'));
    }
    public function create_new_password_post(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);
        User::find($id)->update([
            'password' => Hash::make($request->password),
        ]);
    }




    function register()
    {
        $building = Building::get();
        $unit = Unit::get();
        $vehicle_type = VehiclesType::get();
        $motor_type = MotorType::get();
        $cars_type = VehiclesBrand::get();


        return view('auth.register', compact('building', 'unit', 'vehicle_type', 'motor_type', 'cars_type'));
    }


    function register_post(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required','min:8','max:20'],
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => ['required ','min:13','max:13', 'unique:' . User::class],
            'vehicle_number' => 'required|digits:6',
            'date_barth' => 'required| date |before:2year',
            'image' => 'required|file|image|mimes:jpeg,jpg,png,svg|max:2048',
            'vehicle_type' => ['required', 'exists:vehicles_types,id'],
            'motor_type' => ['required', 'exists:motor_types,id'],
            'VehiclesBrand' => ['required', 'exists:VehiclesBrands,id'],
            'building' => ['required', 'exists:buildings,id'],
            'unit' => ['required', 'exists:units,id'],
            'vehicle_color' => ['required', 'string', 'min:3', 'max:20'],
        ]);
    if ($request->image) {
            $image = $request->image;
            $image = $image->storePublicly('users', 'new');
        }


        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'second_name' => $request->last_name,
            'phone' => $request->phone,
            'date_birth' => $request->date_barth,
            'image' => $image,
            'unit_id' => $request->unit,
            'building_id' => $request->building,
            'type' => 'user'
        ]);

        $vehicle = Vehicle::create([
            'vehicle_number' => $request->vehicle_number,
            'vehicle_type_id' => $request->vehicle_type,
            'motor_type_id' => $request->motor_type,
            'VehiclesBrand_id' => $request->VehiclesBrand,
            'category_id' => 1,
            'color' => $request->vehicle_color,
            'user_id' => $user->id
        ]);



        event(new Registered($user));

        Auth::login($user);

        return redirect(route('website.'));
    }
}
