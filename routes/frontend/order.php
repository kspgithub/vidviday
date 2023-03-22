<?php

use App\Http\Controllers\Order\OrderController;

Route::group([
    'as' => 'order.',
], function () {
    Route::get('order', [OrderController::class, 'index'])->name('index');

    Route::post('order', [OrderController::class, 'store'])->name('store');
    Route::get('order/corporate', [OrderController::class, 'corporate'])->name('corporate');
    Route::get('order/{url}/success', [OrderController::class, 'success'])->name('success');
    Route::get('order/{order}/purchase', [OrderController::class, 'purchase'])->name('purchase');
    Route::post('order/{id}/cancel', [OrderController::class, 'cancel'])->name('cancel');
});
