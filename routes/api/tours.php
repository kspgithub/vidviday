<?php


use App\Http\Controllers\Api\ToursController;

Route::group([
    'as' => 'tours.',
    'prefix' => 'tours',
], function () {
    Route::get('', [ToursController::class, 'index'])->name('index');
    Route::get('popular', [ToursController::class, 'popular'])->name('popular');
    Route::get('autocomplete', [ToursController::class, 'autocomplete'])->name('autocomplete');
    Route::get('{tour}/schedules', [ToursController::class, 'schedules'])->name('schedules');
});
