<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AddtasksController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\FlagsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\SpacesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SubtasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/admin/tasks', TasksController::class);

Route::resource('/admin/statuses', StatusesController::class);

Route::resource('/admin/flags', FlagsController::class);

Route::resource('/admin/comments', CommentsController::class);

Route::resource('/admin/spaces', SpacesController::class);

Route::resource('/admin/users', UsersController::class);

Route::resource('/admin/subtasks', SubtasksController::class);

Route::any('/dashboard/addtask', [AddtasksController::class,'addtask']);
Route::any('/dashboard/addsubtask/{id}', [AddtasksController::class,'addsubtask']);
Route::any('/dashboard/uptask/{id}', [AddtasksController::class,'uptask']);
Route::any('/dashboard/upsubtask/{id}', [AddtasksController::class,'upsubtask']);

Route::post('/dashboard/checktask/{id}', [AddtasksController::class,'checktask'])->name('checktask');
Route::post('/dashboard/checksubtask/{id}', [AddtasksController::class,'checksubtask'])->name('checksubtask');
Route::delete('/dashboard/task/{id}', [AddtasksController::class,'destroy'])->name('destroytask');

Route::delete('/dashboard/subtask/{id}', [AddtasksController::class,'destroySub'])->name('destroysubtask');

Route::any('/dashboard', [AddtasksController::class,'read'])->name('dashboard_read');

Route::any('/board', [AddtasksController::class,'board'])->name('board');

Route::any('/calendar', [AddtasksController::class,'calendar'])->name('calendar');

Route::any('/gant', [AddtasksController::class,'gant'])->name('gant');

Route::any('/subtask', [AddtasksController::class,'subtask'])->name('subtask');

require __DIR__.'/auth.php';
