<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\KovorkingControllerApi;
use App\Http\Controllers\ObjectTypeController;
use App\Http\Controllers\BookingControllerApi;
use App\Http\Controllers\UserControllerApi;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
Route::middleware('auth:sanctum')->get('/users', [UserControllerApi::class,'index']);

Route::middleware('auth:sanctum')->get('/user/{id}', [UserControllerApi::class,'show']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});

Route::get('/bookings', [BookingControllerApi::class,'index']);

Route::get('/booking/{id}', [BookingControllerApi::class,'show']);
Route::get('/kovorkings', [KovorkingControllerApi::class,'index']);
Route::get('/kovorking/{id}', [KovorkingControllerApi::class,'show']);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/logout',[AuthController::class, 'logout']);
