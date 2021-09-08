<?php

use App\Http\Controllers\Tour\TourController;

Route::group([
    'as' => 'tour.',
], function () {
    Route::get('tours/{group?}', [TourController::class, 'index'])->name('index');
    Route::get('tour/{slug}', [TourController::class, 'show'])->name('show');
    Route::get('tour/{slug}/order', [TourController::class, 'order'])->name('order');
    Route::post('tour/{tour}/question', [TourController::class, 'question'])->name('question');
    Route::post('tour/{tour}/testimonial', [TourController::class, 'testimonial'])->name('testimonial');
});
