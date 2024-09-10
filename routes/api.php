<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Merchandise;
use App\Http\Controllers\Api\Order;
use App\Http\Controllers\Api\Shipment;
use App\Http\Controllers\Api\Tracking;
use App\Http\Controllers\Api\Process;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('order', Order::class);
// Route::apiResource('merchandise', Merchandise::class);
// Route::apiResource('shipment', Shipment::class);
// Route::apiResource('tracking', Tracking::class);

Route::controller(Process::class)->group(function () {
    Route::post('input', 'import');
    Route::get('data/{id?}', 'data');
});

Route::controller(Shipment::class)->group(function () {
    Route::get('shipment', 'index');
    Route::get('shipment/search/{key?}', 'search');
});

Route::controller(Order::class)->group(function () {
    Route::get('order', 'index');
    Route::get('order/search/{key?}', 'search');
});

Route::controller(Merchandise::class)->group(function () {
    Route::get('merchandise', 'index');
    Route::get('merchandise/search/{key?}', 'search');
});
