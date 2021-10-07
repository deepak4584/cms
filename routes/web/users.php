<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
Route::get('/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');

Route::middleware('role:admin', 'auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/attach', [UserController::class, 'attach'])->name('users.role.attach');
    Route::put('/users/{user}/detach', [UserController::class, 'detach'])->name('users.role.detach');
});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
});