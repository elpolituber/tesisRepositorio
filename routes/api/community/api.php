<?php

use App\Http\Controllers\Community\beneficiaryInstitutionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Community\combosController;
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

//post
Route::post('/project', [projectsController::class, 'create']);
Route::post('/combo', [combosController::class, 'create']);
Route::post('/beneficiary', [beneficiaryInstitutionController::class, 'search']);
Route::post('/creator', [projectsController::class, 'creador']);
//put
Route::put('/project', [projectsController::class, 'update']);

//delete
Route::delete('project/{id}',[projectsController::class, 'destroy']);


