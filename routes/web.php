<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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
    return redirect(route('home'));
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::controller(TaskController::class)->group(function() {
        Route::get('/tasks', 'index')->name('home');
        Route::post('/tasks', 'store')->name('tasks.store');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
        Route::put('/tasks/{task}/update', 'update')->name('tasks.update');
        Route::patch('/tasks/{task}/complete', 'completeTask')->name('tasks.complete');
        Route::delete('/tasks/{task}/delete', 'destroy')->name('tasks.delete');
        Route::get('/tasks/completed', 'showCompletedTasks')->name('tasks.completed');
        Route::patch('/tasks/{task}/restore', 'restoreTask')->name('tasks.restore');
    });
});

