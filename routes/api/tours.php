<?php


use App\Http\Controllers\Api\ToursController;

Route::group([
    'as' => 'tours.',
    'prefix' => 'tours',
], function () {
    Route::get('', [ToursController::class, 'index'])->name('index');
});
