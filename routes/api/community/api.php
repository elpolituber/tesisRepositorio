<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Community\combosController;
use App\Http\Controllers\Community\observationController;
use App\Http\Controllers\Community\projectsController;

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
//get 
Route::get('/combo', [combosController::class, 'show']);
Route::get('/project', [projectsController::class, 'show']);
Route::get('/project/{id}', [projectsController::class, 'edit']);
Route::get('/creator', [projectsController::class, 'creador']);

//post
Route::post('/project', [projectsController::class, 'create']);
Route::post('/projectV', [projectsController::class, 'show']);
Route::post('/combo', [combosController::class, 'create']);
Route::post('/observation', [observationController::class, 'create']);

//put


//delete
Route::delete('project/{id}',[projectsController::class, 'destroy']);


