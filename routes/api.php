<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/users',[UserController::class,'index']);
    Route::post('/users',[UserController::class,'store']);
});

