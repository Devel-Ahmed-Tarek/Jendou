<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/aramex/create-shipment', [\Plugin\Carrier\Http\Controllers\AramexController::class, 'createShipment']);
Route::get('/aramex/print-label/{shipmentNumber}', [\Plugin\Carrier\Http\Controllers\AramexController::class, 'printLabel']);
