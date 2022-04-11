<?php

use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\GantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddtasksController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/taskGant/{id}', [GantController::class,'index']);
Route::get('/executor/{name}', [ExecutorController::class,'index']);

Route::patch('/updateStatus/{id}', [AddtasksController::class,'updateStatus']);

