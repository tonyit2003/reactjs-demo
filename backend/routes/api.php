<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', action: [UserController::class, 'index']);
});

Route::get('/search-user', action: [UserController::class, 'search']);
Route::post('/create-user', action: [UserController::class, 'store']);
Route::put('/edit-user/{id}', [UserController::class, 'update']);
Route::delete('/delete-user/{id}', [UserController::class, 'delete']);
