<?php


use App\Http\Controllers\Admin\Certificate\CertificateController;
use App\Http\Controllers\Admin\Order\OrderController;

Route::resource('order', OrderController::class);
Route::resource('certificate', CertificateController::class);
