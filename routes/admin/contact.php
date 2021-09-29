<?php

use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('update', [ContactController::class, 'update'])->name('contact.update');

