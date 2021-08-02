<?php

use App\Http\Controllers\Admin\LoginController;

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login.create');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');
