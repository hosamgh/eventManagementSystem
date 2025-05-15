<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;


Route::apiResource('booking', BookingController::class)->only(['store', 'index']);
Route::post('login',[AuthController::class,'login']);


Route::apiResource('events', EventController::class);