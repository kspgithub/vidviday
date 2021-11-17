<?php

use App\Http\Controllers\Admin\Transport\OrderTransportController;
use App\Http\Controllers\Admin\Transport\TransportController;
use Illuminate\Support\Facades\Route;

Route::resource('transport', TransportController::class);
Route::resource('order-transport', OrderTransportController::class)->only(['index', 'show', 'edit', 'update']);
