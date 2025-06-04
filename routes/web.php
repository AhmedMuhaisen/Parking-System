<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
Route::post('/reset_password', [AuthController::class, 'reset_password_post'])->name('reset_password_post');
Route::get('/create_new_password/{id}', [AuthController::class, 'create_new_password'])->name('create_new_password');
Route::post('/create_new_password/{id}', [AuthController::class, 'create_new_password_post'])->name('create_new_password_post');



Route::prefix('website')->name('website.')->middleware('auth')->group(function () {
    Route::get('/', [WebsiteController::class, 'index']);
    Route::post('/contact', [WebsiteController::class, 'contact'])->name('contact');
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



Route::prefix('Dashboard')->name('Dashboard.')->middleware('auth')->group(function () {
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
});
