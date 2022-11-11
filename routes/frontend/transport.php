<?php

use App\Http\Controllers\Transport\TransportController;

Route::post('/transport', [TransportController::class, 'order'])->name('transport.order');
