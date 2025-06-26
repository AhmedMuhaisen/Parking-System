<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\BuildingController;
use App\Http\Controllers\Dashboard\CameraController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\gateController;
use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\Dashboard\Login_AttemptController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\Notification_RuleController;
use App\Http\Controllers\Dashboard\ParkingController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\Register_RequestController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SpotController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Dashboard\UnitController;
use App\Http\Controllers\Dashboard\userController;
use App\Http\Controllers\Dashboard\UserRoleController;
use App\Http\Controllers\Dashboard\VehicleController;
use App\Http\Controllers\Dashboard\VehicleMovementController;
use App\Http\Controllers\Dashboard\VehiclesBrandController;
use App\Http\Controllers\Dashboard\VehiclesTypeController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register');

Route::get('/log_register_request', [AuthController::class, 'register_request'])->name('log_register_request');

Route::post('/log_register_request', [AuthController::class, 'register_request_post'])->name('log_register_request_post');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
Route::post('/reset_password', [AuthController::class, 'reset_password_post'])->name('reset_password_post');
Route::get('/create_new_password/{id}', [AuthController::class, 'create_new_password'])->name('create_new_password');
Route::post('/create_new_password/{id}', [AuthController::class, 'create_new_password_post'])->name('create_new_password_post');

Route::post('website/contact', [WebsiteController::class, 'contact'])->name('website.contact');

Route::prefix('website')->name('website.')->middleware('auth')->group(function () {
    Route::get('/', [WebsiteController::class, 'index']);

    Route::get('/profile', [WebsiteController::class, 'profile'])->name('profile');
    Route::post('/edit_personal/{id}', [WebsiteController::class, 'edit_personal_post'])->name('edit_personal');



    Route::post('edit_vehicle/{id}', [WebsiteController::class, 'edit_vehicle_post'])->name('edit_vehicle');
    Route::post('add_vehicle', [WebsiteController::class, 'add_vehicle_post'])->name('add_vehicle');
    Route::delete('delete_vehicle/{id}', [WebsiteController::class, 'delete_vehicle'])->name('delete_vehicle');

    Route::post('/edit_guest/{id}', [WebsiteController::class, 'edit_guest_post'])->name('edit_guest');
    Route::post('/add_guest', [WebsiteController::class, 'add_guest_post'])->name('add_guest');
    Route::delete('delete_guest/{id}', [WebsiteController::class, 'delete_guest'])->name('delete_guest');


    Route::post('/edit_testimonial/{id}', [WebsiteController::class, 'edit_testimonial_post'])->name('edit_testimonial');


    Route::post('/add_testimonial', [WebsiteController::class, 'add_testimonial_post'])->name('add_testimonial');

    Route::delete('delete_testimonial/{id}', [WebsiteController::class, 'delete_testimonial'])->name('delete_testimonial');
});



Route::prefix('Dashboard')->name('Dashboard.')->middleware('auth','admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('');

    Route::delete('contact/destroy/{id}', [DashboardController::class, 'destroy'])->name('contact.destroy');

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');

        Route::get('search', [CategoryController::class, 'search'])->name('search');

        Route::get('exportPDF', [CategoryController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [CategoryController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [CategoryController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [CategoryController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [CategoryController::class, 'restore'])->name('restore');
    });
    Route::resource('category', CategoryController::class);


    Route::prefix('vehiclesType')->name('vehiclesType.')->group(function () {
        Route::get('/', [VehiclesTypeController::class, 'index'])->name('index');

        Route::get('search', [VehiclesTypeController::class, 'search'])->name('search');

        Route::get('exportPDF', [VehiclesTypeController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [VehiclesTypeController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [VehiclesTypeController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [VehiclesTypeController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [VehiclesTypeController::class, 'restore'])->name('restore');
    });
    Route::resource('vehiclesType', VehiclesTypeController::class);




    Route::prefix('vehiclesBrand')->name('vehiclesBrand.')->group(function () {
        Route::get('/', [VehiclesBrandController::class, 'index'])->name('index');

        Route::get('search', [VehiclesBrandController::class, 'search'])->name('search');

        Route::get('exportPDF', [VehiclesBrandController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [VehiclesBrandController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [VehiclesBrandController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [VehiclesBrandController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [VehiclesBrandController::class, 'restore'])->name('restore');
    });
    Route::resource('vehiclesBrand', VehiclesBrandController::class);

    Route::prefix('vehicle')->name('vehicle.')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('index');

        Route::get('search', [VehicleController::class, 'search'])->name('search');

        Route::get('exportPDF', [VehicleController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [VehicleController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [VehicleController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [VehicleController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [VehicleController::class, 'restore'])->name('restore');
    });
    Route::resource('vehicle', VehicleController::class);

    Route::prefix('vehicleMovement')->name('vehicleMovement.')->group(function () {
        Route::get('/', [VehicleMovementController::class, 'index'])->name('index');

        Route::get('search', [VehicleMovementController::class, 'search'])->name('search');

        Route::get('exportPDF', [VehicleMovementController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [VehicleMovementController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [VehicleMovementController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [VehicleMovementController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [VehicleMovementController::class, 'restore'])->name('restore');
    });
    Route::resource('vehicleMovement', VehicleMovementController::class);



    Route::prefix('login_attempt')->name('login_attempt.')->group(function () {
        Route::get('/', [Login_AttemptController::class, 'index'])->name('index');

        Route::get('search', [Login_AttemptController::class, 'search'])->name('search');

        Route::get('exportPDF', [Login_AttemptController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [Login_AttemptController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [Login_AttemptController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [Login_AttemptController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [Login_AttemptController::class, 'restore'])->name('restore');
    });
    Route::resource('login_attempt', Login_AttemptController::class);




    Route::prefix('vehiclesBrand')->name('vehiclesBrand.')->group(function () {
        Route::get('/', [VehiclesBrandController::class, 'index'])->name('index');

        Route::get('search', [VehiclesBrandController::class, 'search'])->name('search');

        Route::get('exportPDF', [VehiclesBrandController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [VehiclesBrandController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [VehiclesBrandController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [VehiclesBrandController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [VehiclesBrandController::class, 'restore'])->name('restore');
    });
    Route::resource('vehiclesBrand', VehiclesBrandController::class);

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [userController::class, 'index'])->name('index');

        Route::get('search', [userController::class, 'search'])->name('search');

        Route::get('exportPDF', [userController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [userController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [userController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [userController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [userController::class, 'restore'])->name('restore');
    });
    Route::resource('user', userController::class);



    Route::prefix('parking')->name('parking.')->group(function () {
        Route::get('/', [ParkingController::class, 'index'])->name('index');

        Route::get('search', [ParkingController::class, 'search'])->name('search');

        Route::get('exportPDF', [ParkingController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [ParkingController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [ParkingController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [ParkingController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [ParkingController::class, 'restore'])->name('restore');
    });
    Route::resource('parking', ParkingController::class);




    Route::prefix('building')->name('building.')->group(function () {
        Route::get('/', [BuildingController::class, 'index'])->name('index');

        Route::get('search', [BuildingController::class, 'search'])->name('search');

        Route::get('exportPDF', [BuildingController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [BuildingController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [BuildingController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [BuildingController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [BuildingController::class, 'restore'])->name('restore');
    });
    Route::resource('building', BuildingController::class);





    Route::prefix('unit')->name('unit.')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('index');

        Route::get('search', [UnitController::class, 'search'])->name('search');

        Route::get('exportPDF', [UnitController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [UnitController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [UnitController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [UnitController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [UnitController::class, 'restore'])->name('restore');
    });

    Route::resource('unit', UnitController::class);

    Route::prefix('gate')->name('gate.')->group(function () {
        Route::get('/', [GateController::class, 'index'])->name('index');

        Route::get('search', [GateController::class, 'search'])->name('search');

        Route::get('exportPDF', [GateController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [GateController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [GateController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [GateController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [GateController::class, 'restore'])->name('restore');
    });
    Route::resource('gate', GateController::class);




    Route::prefix('spot')->name('spot.')->group(function () {
        Route::get('/', [SpotController::class, 'index'])->name('index');

        Route::get('search', [SpotController::class, 'search'])->name('search');

        Route::get('exportPDF', [SpotController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [SpotController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [SpotController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [SpotController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [SpotController::class, 'restore'])->name('restore');
    });

    Route::resource('spot', SpotController::class);


    Route::prefix('guest')->name('guest.')->group(function () {
        Route::get('/', [GuestController::class, 'index'])->name('index');

        Route::get('search', [GuestController::class, 'search'])->name('search');

        Route::get('exportPDF', [GuestController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [GuestController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [GuestController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [GuestController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [GuestController::class, 'restore'])->name('restore');
    });

    Route::resource('guest', GuestController::class);

    Route::prefix('camera')->name('camera.')->group(function () {
        Route::get('/', [CameraController::class, 'index'])->name('index');

        Route::get('search', [CameraController::class, 'search'])->name('search');

        Route::get('exportPDF', [CameraController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [CameraController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [CameraController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [CameraController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [CameraController::class, 'restore'])->name('restore');
    });

    Route::resource('camera', CameraController::class);

      Route::prefix('message')->name('message.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');

        Route::get('search', [MessageController::class, 'search'])->name('search');

        Route::get('exportPDF', [MessageController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [MessageController::class, 'exportExcel'])->name('exportExcel');

            Route::delete('destroy/{id}', [MessageController::class, 'destroy'])->name('destroy');

        Route::delete('forcedelete/{id}', [MessageController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [MessageController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [MessageController::class, 'restore'])->name('restore');
    });

   Route::prefix('notification_rule')->name('notification_rule.')->group(function () {
        Route::get('/', [Notification_RuleController::class, 'index'])->name('index');

        Route::get('search', [Notification_RuleController::class, 'search'])->name('search');

        Route::get('exportPDF', [Notification_RuleController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [Notification_RuleController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [Notification_RuleController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [Notification_RuleController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [Notification_RuleController::class, 'restore'])->name('restore');
    });
    Route::resource('notification_rule', Notification_RuleController::class);


    Route::prefix('testimonial')->name('testimonial.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');

        Route::get('search', [TestimonialController::class, 'search'])->name('search');

        Route::get('exportPDF', [TestimonialController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [TestimonialController::class, 'exportExcel'])->name('exportExcel');


        Route::delete('forcedelete/{id}', [TestimonialController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [TestimonialController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [TestimonialController::class, 'restore'])->name('restore');
    });

    Route::resource('testimonial', TestimonialController::class);


    Route::prefix('register_request')->name('register_request.')->group(function () {
        Route::get('/', [Register_RequestController::class, 'index'])->name('index');
        Route::get('search', [Register_RequestController::class, 'search'])->name('search');
        Route::get('exportPDF', [Register_RequestController::class, 'exportPDF'])->name('exportPDF');

        Route::get('exportExcel', [Register_RequestController::class, 'exportExcel'])->name('exportExcel');
        Route::delete('forcedelete/{id}', [Register_RequestController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [Register_RequestController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [Register_RequestController::class, 'restore'])->name('restore');

        Route::get('accept/{id}', [Register_RequestController::class, 'accept'])->name('accept');
    });
    Route::resource('register_request', Register_RequestController::class);




    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::delete('forcedelete/{id}', [PermissionController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [PermissionController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [PermissionController::class, 'restore'])->name('restore');
    });
    Route::resource('permission', PermissionController::class);


    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::delete('forcedelete/{id}', [RoleController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [RoleController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [RoleController::class, 'restore'])->name('restore');
    });
    Route::resource('role', RoleController::class);


    Route::prefix('user_role')->name('user_role.')->group(function () {
        Route::get('/', [UserRoleController::class, 'index'])->name('index');
        Route::delete('destroy/{id}', [UserRoleController::class, 'destroy'])->name('destroy');
        Route::get('edit/{id}', [UserRoleController::class, 'edit'])->name('edit');
        Route::get('create', [UserRoleController::class, 'create'])->name('create');
        Route::put('update', [UserRoleController::class, 'update'])->name('update');
        Route::get('trash', [UserRoleController::class, 'trash'])->name('trash');
    });


    Route::prefix('color')->name('color.')->group(function () {
        Route::get('/', [ColorController::class, 'index'])->name('index');
        Route::delete('forcedelete/{id}', [ColorController::class, 'delete'])->name('forcedelete');
        Route::get('trash', [ColorController::class, 'trash'])->name('trash');
        Route::get('restore/{id}', [ColorController::class, 'restore'])->name('restore');
    });
    Route::resource('color', ColorController::class);
});
