<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::group(['prefix' => 'tasks', 'middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'check.admin'], function () {
        Route::get('/admin', [TaskController::class, 'indexAdmin']);
        Route::delete('/{id}', [TaskController::class, 'destroy']);
    });

    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/{id}', [TaskController::class, 'show']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::post('/reorder', [TaskController::class, 'reorder']);
});