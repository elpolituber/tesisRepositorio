<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\PermissionController;
use App\Http\Controllers\Authentication\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Users
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
//    Route::group(['middleware' => 'auth:api'], function () {

        Route::put('password', [AuthController::class, 'changePassword']);
        Route::put('users', [AuthController::class, 'update']);
        Route::get('users/detail', [AuthController::class, 'getUser']);
        Route::get('users', [AuthController::class, 'index']);
        Route::post('users', [AuthController::class, 'create']);
        Route::delete('users/{id}', [AuthController::class, 'destroy']);
        Route::post('users/avatar', [AuthController::class, 'uploadAvatarUri']);
        Route::get('users/permissions', [AuthController::class, 'getPermissions']);
//    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('permissions', PermissionController::class)->middleware('auth:api');
    Route::apiResource('routes', RouteController::class);
});
