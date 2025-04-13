<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Session;
use App\Http\Middleware\IsMaster;

Route::middleware(['web'])->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/login', 'login');
    });

    
    Route::controller(UsersController::class)->group(function () {
        Route::get('/users', 'index');
        Route::post('/users', 'registerUser');
    });

    Route::middleware([Session::class])->group(function () {

        Route::get('/home', [HomeController::class, 'index']);

        Route::controller(BookingController::class)->group(function () {
            Route::post('/booking-register', 'registerBooking');
            Route::get('/booking-register/edit/{id}', 'getBookingById');
            Route::get('/booking', 'index')->name('booking');
            Route::get('/booking-delete/{id}', 'deleteBooking');
            Route::get('/my-bookings', 'getBookingByCostumer');
        });

        Route::middleware(IsMaster::class)->controller(DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::post('/booking-chart', 'getBookingsByPeriod');
        });

        Route::middleware(IsMaster::class)->controller(UsersController::class)->group(function () {
            Route::get('/users-list', 'getAll');
            Route::get('/user-delete/{id}', 'deleteUser');
        });

        Route::controller(LogoutController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
        });
    });
});
