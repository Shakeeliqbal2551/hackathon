<?php

use App\Http\Controllers\{BookableSlotController, BookingController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('calendar', [BookableSlotController::class, 'calendar'])->name('calender');
Route::post('booking', [BookingController::class, 'store'])->name('store.booking');
