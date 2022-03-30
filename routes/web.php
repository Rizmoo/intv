<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('api')->group(function () {
    Route::resource('shipment', \App\Http\Controllers\ShipmentController::class);
    Route::resource('order', \App\Http\Controllers\OrderController::class);
    Route::resource('fleet', \App\Http\Controllers\FleetController::class);
    Route::any('order/ship/{order}', [\App\Http\Controllers\OrderController::class,'assign']);
    Route::get('active/shipments', [\App\Http\Controllers\ShipmentController::class,'active']);
});



