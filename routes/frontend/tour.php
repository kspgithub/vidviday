<?php

use App\Http\Controllers\Tour\TourController;

Route::group([
    'as'=>'tour.',
    'prefix'=>'tour',
], function () {
    Route::get('{group?}', [TourController::class, 'index'])->name('index');
    Route::get('{tour}/details', [TourController::class, 'show'])->name('show');
    Route::get('{tour}/order', [TourController::class, 'order'])->name('order');
});
