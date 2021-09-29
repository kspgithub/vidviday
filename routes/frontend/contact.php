<?php

use App\Http\Controllers\Contact\ContactController;

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');


