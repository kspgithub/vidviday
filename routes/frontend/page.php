<?php

use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\PageController;

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('{slug}', [PageController::class, 'show'])->name('page.show');
