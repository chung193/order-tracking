<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Merchandise;
use App\Http\Controllers\Api\Order;
use App\Http\Controllers\Api\Shipment;
use App\Http\Controllers\Api\Tracking;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('order', Order::class);
Route::apiResource('merchandise', Merchandise::class);
Route::apiResource('shipment', Shipment::class);
Route::apiResource('tracking', Tracking::class);
