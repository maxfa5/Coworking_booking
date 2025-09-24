<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\KovorkingController;
use App\Http\Controllers\ObjectTypeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hellow World!']);
});

Route::get('/cities', [CityController::class,'index']);

Route::get('/buildings', [BuildingController::class,'index']);

Route::get('/kovorkings', [KovorkingController::class,'index']);
Route::get('/object_types', [ObjectTypeController::class,'index']);