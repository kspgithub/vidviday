<?php

use App\Http\Controllers\Corporate\CorporateController;

Route::get('/corporates', [CorporateController::class, 'index'])->name('corporates');
