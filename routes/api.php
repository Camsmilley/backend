<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SafariController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PaymentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/total-guest', [AuthController::class, 'totalGuest']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('allHomeSafaris', [SafariController::class, 'index']);
Route::get('safaris/{id}', [SafariController::class, 'show']);

Route::post('safaris', [SafariController::class, 'store']);
Route::post('safaris/{id}', [SafariController::class, 'update']);
Route::delete('safaris/{id}', [SafariController::class, 'destroy']);



Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::put('/bookings/{id}/confirmed', [BookingController::class, 'update_confirmed']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

Route::get('/payment', [PaymentController::class, 'handleWebhook']);
Route::get('/daily-bookings', [BookingController::class, 'dailyBookings']);

// total

Route::get('/total-bookings', [BookingController::class, 'totalBookings']);
Route::get('/total-guides', [GuideController::class, 'totalGuides']);
Route::get('/total-tours', [SafariController::class, 'totalTours']);

Route::resource('guides', GuideController::class);

// New route for fetching bookings by guestId
Route::get('/user-bookings/{guestId}', [BookingController::class, 'userBookings']);

Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']);
