<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowRoomsController;
use App\Http\Controllers\BookingController;
use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return redirect()->action('App\Http\Controllers\BookingController@index');

    $booking=DB::table('bookings')->get();
    // $bookings= Booking::paginate(1);
    return view('bookings.index')
    // ->with('bookings', $bookings)
    ->with('booking', $booking);
 });
 
Route::get('/rooms/{roomType?}', [ShowRoomsController::class, 'rooms_']);
Route::resource('/bookings','App\Http\Controllers\BookingController');