<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\KovorkingController;
use App\Http\Controllers\ObjectTypeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hellow World!']);
});

Route::get('/cities', [CityController::class,'index']);
Route::get('/city/{id}', [CityController::class,'show']);

Route::get('/buildings', [BuildingController::class,'index']);

Route::get('/kovorkings', [KovorkingController::class,'index']);

Route::get('/object_types', [ObjectTypeController::class,'index']);
Route::get('/object_type/{id}', [ObjectTypeController::class,'show']);

Route::get('/bookings', [BookingController::class,'index']);

Route::get('/booking/{id}', [BookingController::class,'show']);

Route::get('/building/{id}', [BuildingController::class,'show']);

Route::get('/kovorking/{id}', [KovorkingController::class,'show']);
Route::get('/users', [UserController::class,'index']);

Route::get('/user/{id}', [UserController::class,'show']);

Route::get('/buildings/create', [BuildingController::class, 'create']);
Route::post('/buildings', [BuildingController::class, 'store']);
Route::get('/building/edit/{id}', [BuildingController::class, 'edit']);
Route::post('/building/update/{id}', [BuildingController::class, 'update']);
