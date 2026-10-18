<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\UserController;


Route::prefix('auth')->group(function () {

    Route::post('register', [AuthController::class, 'register']);

    Route::post('login', [AuthController::class, 'login']);

    Route::post('refresh', [AuthController::class, 'refresh']);
});


// Protected Auth Routes
Route::middleware('auth:api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);

        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::apiResource('diaries', DiaryController::class);
    Route::get('users/list', [UserController::class, 'list']);
    Route::apiResource('users', UserController::class);
});
