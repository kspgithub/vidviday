<?php

use App\Http\Controllers\Broker\BrokerController;

Route::get('/broker', [BrokerController::class, 'index'])->name('broker.index');
Route::post('/broker', [BrokerController::class, 'order'])->name('broker.order');


