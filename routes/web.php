<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LessonsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLessonsController;
use App\Http\Controllers\Admin\UserlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//user
Route::middleware('auth', 'userMiddleware')->group(function () {

    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('lessons', [LessonsController::class, 'index'])->name('user.lessons');
});

//admin
Route::middleware('auth', 'adminMiddleware')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/lessons', [AdminLessonsController::class, 'index'])->name('admin.lessons');
    Route::get('admin/users', [UserlistController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}/edit', [UserlistController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{id}', [UserlistController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{id}', [UserlistController::class, 'destroy'])->name('admin.users.destroy');
});
