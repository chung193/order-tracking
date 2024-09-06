<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('Order', 'Api\Order');
Route::apiResource('Merchandise', 'Api\Merchandise');
Route::apiResource('Shipment', 'Api\Shipment');
Route::apiResource('Tracking', 'Api\Tracking');
