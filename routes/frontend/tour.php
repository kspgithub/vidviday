<?php

use App\Http\Controllers\Tour\TourController;

Route::group([
    'as' => 'tour.',
], function () {
    Route::get('tour/order/{order}/success', [TourController::class, 'orderSuccess'])->name('order-success');

    Route::get('tours/download', [TourController::class, 'download'])->name('download');
    Route::get('tours/{group?}', [TourController::class, 'index'])->name('index');
    //Route::get('tour/{slug}', [TourController::class, 'show'])->name('show');
    Route::get('tour/{tour}/order', [TourController::class, 'order'])->name('order');
    Route::post('tour/{tour}/order', [TourController::class, 'orderConfirm'])->name('order-confirm');
    Route::post('tour/{tour}/vote', [TourController::class, 'voting'])->name('voting');
    Route::get('tour/{tour}/vote/{vote}/success', [TourController::class, 'votingSuccess'])->name('voting-success');

    Route::post('tour/{tour}/question', [TourController::class, 'question'])->name('question');
    Route::post('tour/{tour}/testimonial', [TourController::class, 'testimonial'])->name('testimonial');
});
