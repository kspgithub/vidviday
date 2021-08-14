<?php

use App\Http\Controllers\Tour\TourController;

Route::group([
    'as' => 'tour.',
], function () {
    Route::get('tours/{group?}', [TourController::class, 'index'])->name('index');
    Route::get('tour/{tour}', [TourController::class, 'show'])->name('show');
    Route::get('tour/{tour}/order', [TourController::class, 'order'])->name('order');
});
