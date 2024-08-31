<?php

use Illuminate\Support\Facades\Route;
use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function () {
    $booking = Booking::first(); // Get the first booking for testing
    Mail::to('mcdharnelpagaragan@gmail.com')->send(new BookingStatusUpdated($booking));
    return 'Test email sent';
});