<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);


Route::group(['prefix' => 'user', 'middleware' => 'User'], function () {
    Route::post('create', [UserController::class, 'create']);
    Route::get('getAll', [UserController::class, 'getAllUsers']);
    Route::post('update', [UserController::class, 'updateUser']);
});
