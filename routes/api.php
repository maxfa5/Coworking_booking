<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\KovorkingControllerApi;
use App\Http\Controllers\ObjectTypeController;
use App\Http\Controllers\BookingControllerApi;
use App\Http\Controllers\UserControllerApi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingControllerApi;
use Illuminate\Http\Request;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/bookings', [BookingControllerApi::class, 'index']);
Route::get('/booking/{id}', [BookingControllerApi::class, 'show']);
Route::get('/bookings_total', [BookingControllerApi::class, 'total']);

Route::get('/kovorkings', [KovorkingControllerApi::class, 'index']);
Route::get('/kovorking/{id}', [KovorkingControllerApi::class, 'show']);
Route::get('/kovorkings_total', [KovorkingControllerApi::class, 'total']);

Route::get('/buildings', [BuildingControllerApi::class, 'index']);
Route::get('/building/{id}', [BuildingControllerApi::class, 'show']);
Route::get('/buildings/city/{cityId}', [BuildingControllerApi::class, 'getByCity']);
Route::get('/buildings/search', [BuildingControllerApi::class, 'search']);
Route::get('/buildings/paginate', [BuildingControllerApi::class, 'paginate']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/kovorkings', [KovorkingControllerApi::class, 'store']);
    Route::get('/users', [UserControllerApi::class, 'index']);
    Route::get('/user/{id}', [UserControllerApi::class, 'show']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/buildings', [BuildingControllerApi::class, 'store']);
    Route::put('/buildings/{id}', [BuildingControllerApi::class, 'update']);
    Route::patch('/buildings/{id}', [BuildingControllerApi::class, 'update']); 
    Route::delete('/buildings/{id}', [BuildingControllerApi::class, 'destroy']);
});
