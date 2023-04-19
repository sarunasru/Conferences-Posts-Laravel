<?php

use Illuminate\Support\Facades\Route;


Route::put('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
Route::delete('/admin/users/{user}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');


Route::middleware('role:Admin')->group(function ()
{
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('/admin/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/admin/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
});

Route::middleware(['auth', 'can:view,user'])->group(function ()
{
    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});
