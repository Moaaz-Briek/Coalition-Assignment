<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [TaskController::class, 'index']);

Route::prefix('tasks')->group(function () {
    Route::get('', [TaskController::class, 'index'])->name('tasks');
    Route::get('show', [TaskController::class, 'show']);
    Route::post('create', [TaskController::class, 'create']);
    Route::get('destroy/{id}', [TaskController::class, 'destroy']);
    Route::match(['get', 'post'], 'edit/{id?}', [TaskController::class, 'edit']);
    Route::post('reorder', [TaskController::class, 'reorder']);
});

Route::prefix('projects/')->group(function () {
    Route::get('', [ProjectController::class, 'index'])->name('projects');
    Route::get('show', [ProjectController::class, 'show']);
    Route::post('create', [ProjectController::class, 'create']);
    Route::match(['get', 'post'],'edit/{id?}', [ProjectController::class, 'edit']);
    Route::get('delete/{id}', [ProjectController::class, 'delete']);
    Route::post('getProjectTasks', [ProjectController::class, 'getProjectTasksUsingAjax']);
});
