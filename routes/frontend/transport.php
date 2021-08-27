<?php

use App\Http\Controllers\Transport\TransportController;

Route::get('/transport', [TransportController::class, 'index'])->name('transport');


