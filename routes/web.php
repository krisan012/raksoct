<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\CreateTaskComponent;
use App\Livewire\TaskListComponent;
use App\Livewire\TaskViewComponent;
use App\Livewire\Users;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users', Users::class)->name('users.list');

    Route::get('/dashboard', TaskListComponent::class)->name('tasks.list');
    Route::get('/tasks/create/{id?}', CreateTaskComponent::class)->name('tasks.create');
    Route::get('/tasks/view/{id}', TaskViewComponent::class)->name('tasks.view');
});

require __DIR__.'/auth.php';
