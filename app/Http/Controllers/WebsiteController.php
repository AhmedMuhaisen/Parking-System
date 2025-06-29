<?php

namespace App\Http\Controllers;

use App\Mail\reset_passwordMail;
use App\Mail\Send_messageMail;
use App\Models\Building;
use App\Models\Color;
use App\Models\VehiclesBrand;
use App\Models\Guest;
use App\Models\Message;
use App\Models\MotorType;
use App\Models\ParkingWork;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Unit;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehiclesType;
use App\Services\NotificationService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;
use PHPUnit\TextUI\XmlConfiguration\Logging\Logging;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

class WebsiteController extends Controller
{
    function index()
    {
        $settings = Setting::first();
        $parking_work = ParkingWork::orderBy('step', 'asc')->get();
        $testimonials = Testimonial::get();

        return view('website.index', compact('settings', 'parking_work', 'testimonials'));
    }

    function profile()
    {
        $settings = Setting::first();
        $buildings = Building::get();
        $units = Unit::get();
        $color = Color::get();

        $vehicles_type = VehiclesType::get();
        $motor_type = MotorType::get();
        $VehiclesBrand = VehiclesBrand::get();
        return view('website.profile', compact('units', 'buildings', 'settings', 'vehicles_type', 'motor_type', 'color', 'VehiclesBrand'));
    }

    function contact(Request $request)
    {


        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                200
            ); // 422 = Unprocessable Entity
        }
        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('ahmedmuhaisen6@gmail.com')->send(new Send_messageMail($data));

        Message::create([
            'email' => $request->email,
            'type' => $request->outgoing,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);





        // success response
        return response('OK', 200);
    }


    function edit_vehicle_post(Request $request, $id, NotificationService $notifier)
    {

        $validator = FacadesValidator::make($request->all(), [
            'vehicle_number' => 'required|string|max:255|digits:6',
            'vehicle_type' => 'required|exists:vehicles_types,id',
            'motor_type' => 'required|exists:motor_types,id',
            'VehiclesBrand' => 'required|exists:vehicles_brands,id',
            'color' => 'required|string|max:255',
            'date_start' => 'required|date|after:today',
            'date_end' => 'required|date|after:date_start',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048',
        ]);

        $data = $validator->validated();
        $data['vehicles_type_id'] = $data['vehicle_type'];
        $data['motor_type_id'] = $data['motor_type'];
        $data['vehicles_brand_id'] = $data['VehiclesBrand'];
        $data['color_id'] = $data['color'];
        // Remove them from the array
        unset($data['vehicle_type'], $data['motor_type'], $data['VehiclesBrand'], $data['color']);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }

        $vehicle =  Vehicle::find($id);
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 200);
        }
        if ($request->image) {
            $image = $request->image;
            $image = $image->storePublicly('vehicles', 'new');
        } else {
            $image = $vehicle->image;
        }
        $data['image'] = $image;

        $vehicle->update($data);

        $notifier->trigger('vehicle', 'edit', $vehicle);
        return response()->json([
            'message' => 'Vehicle updated successfully',
            'status' => 200
        ]);
    }

    function add_vehicle_post(Request $request, NotificationService $notifier)
    {

        $validator = FacadesValidator::make($request->all(), [
            'vehicle_number' => 'required|string|max:255|digits:6',
            'vehicle_type' => 'required|exists:vehicles_types,id',
            'motor_type' => 'required|exists:motor_types,id',
            'VehiclesBrand' => 'required|exists:vehicles_brands,id',
            'color' => 'required|string|max:255',

            'date_start' => 'required|date|after:today',
            'date_end' => 'required|date|after:date_start',
            'image' => 'required|image|mimes:jpeg,jpg,png,svg,webp|max:2048',

        ]);



        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }
        $image = $request->image->storePublicly('vehicles', 'new');


        $data = $validator->validated();
        $data['image'] = $image;
        $data['vehicles_type_id'] = $data['vehicle_type'];
        $data['motor_type_id'] = $data['motor_type'];
        $data['vehicles_brand_id'] = $data['VehiclesBrand'];
        $data['color_id'] = $data['color'];


        unset($data['vehicle_type'], $data['motor_type'], $data['VehiclesBrand'], $data['color']);

        $data['category_id'] = 1;
        $data['user_id'] = Auth::user()->id;
        $vehicle = Vehicle::Create($data);
        $notifier->trigger('vehicle', 'crete', $vehicle);
        return response()->json([
            'message' => 'Vehicle Add successfully',
            'status' => 200
        ]);
    }
    function delete_vehicle(Request $request, $id, NotificationService $notifier)
    {

        $vehicle = Vehicle::find($id)->delete();
        $notifier->trigger('vehicle', 'delete', $vehicle);
        return redirect()->route('website.profile')->with('msg', 'Vehicle Deleted successfully');
    }

    function edit_guest_post(Request $request, $id, NotificationService $notifier)
    {

        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'vehicle_number' => 'required|digits:6',
            'login_date' => 'required|date',
            'login_time' => 'required|string|max:40',
            'logOut_date' => 'required|date|after_or_equal:today|after_or_equal:login_date',
            'logOut_time' => 'required|string|max:40|after_or_equal:login_time',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }

        $guest = Guest::find($id);
        if (!$guest) {
            return response()->json(['error' => 'guest not found'], 200);
        }

        $guest->update($validator->validated());
        $notifier->trigger('guest', 'edit', $guest);
        return response()->json([
            'message' => 'guest updated successfully',
            'status' => 200
        ]);
    }



    function add_guest_post(Request $request, NotificationService $notifier)
    {

        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'vehicle_number' => 'required|digits:6',
            'login_date' => 'required|date',
            'login_time' => 'required|string|max:40',
            'logOut_date' => 'required|date|after_or_equal:today|after_or_equal:login_date',
            'logOut_time' => 'required|string|max:40|after_or_equal:login_time',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }


        $data = $validator->validated();

        $data['user_id'] = Auth::user()->id;
        $guest = Guest::create($data);
        $notifier->trigger('guest', 'crete', $guest);
        return response()->json([
            'message' => 'guest Add successfully',
            'status' => 200
        ]);
    }




    function delete_guest(Request $request, $id, NotificationService $notifier)
    {

        $guest = Guest::find($id)->delete();
        $notifier->trigger('guest', 'delete', $guest);
        return redirect()->route('website.profile')->with('msg', 'guest Deleted successfully');
    }



    function edit_testimonial_post(Request $request, $id, NotificationService $notifier)
    {

        $validator = FacadesValidator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'text' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }

        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['error' => 'testimonial not found'], 200);
        }

        $testimonial->update($validator->validated());
        $notifier->trigger('testimonial', 'edit', $testimonial);
        return response()->json([
            'message' => 'testimonial updated successfully',
            'status' => 200
        ]);
    }

    function add_testimonial_post(Request $request, NotificationService $notifier)
    {

        $validator = FacadesValidator::make($request->all(), [
            'rating' => 'required|integer|between:1,5',
            'text' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }

        $data = $validator->validated();

        $data['user_id'] = Auth::user()->id;

        $testimonial = Testimonial::create($data);
        $notifier->trigger('testimonial', 'crete', $testimonial);
        return response()->json([
            'message' => 'testimonial Add successfully',
            'status' => 200
        ]);
    }



    function delete_testimonial(Request $request, $id, NotificationService $notifier)
    {

        $testimonial = Testimonial::find($id)->delete();
        $notifier->trigger('testimonial', 'delete', $testimonial);
        return redirect()->route('website.profile')->with('msg', 'testimonial Deleted successfully');
    }



    function edit_personal_post(Request $request, $id, NotificationService $notifier)
    {
        $validator = FacadesValidator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048',

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],

            'building_id' => ['required', 'exists:buildings,id'],
            'unit_id' => ['required', 'exists:units,id'],

            'phone' => [
                'required',
                'min:10',
                'max:12',
                Rule::unique('users', 'phone')->ignore($id),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200); // Use 422 for validation errors
        }
        if ($request->image) {
            $image = $request->image;
            $image = $image->storePublicly('product', 'new');
        } else {
            $image = Auth::user()->image;
        }

        $data = $validator->validated();
        $data['image'] = $image;


        $user = Auth::user()->update($data);
        $notifier->trigger('user', 'edit', $user);
        return response()->json([
            'message' => 'Vehicle updated successfully',
            'status' => 200
        ]);
    }
}
