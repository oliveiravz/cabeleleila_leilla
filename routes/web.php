<?php
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'App\Http\Controllers\LoginController@index');
    Route::post('/login', 'App\Http\Controllers\LoginController@login');
});

Route::middleware(['web'])->group(function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@index');
});

Route::controller(BookingController::class)->group(function () {
    Route::get('/booking','App\Http\Controllers\BookingController@index')->name('booking');
    Route::post('/booking-register','App\Http\Controllers\BookingController@registerBooking');
    Route::get('/booking-delete/{id}','App\Http\Controllers\BookingController@deleteBooking');

    Route::get('/booking-register/{id}','App\Http\Controllers\BookingController@getBookingById');
    Route::get('/my-bookings','App\Http\Controllers\BookingController@getBookingByCostumer');
});

Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout','App\Http\Controllers\LogoutController@logout')->name('logout');
});