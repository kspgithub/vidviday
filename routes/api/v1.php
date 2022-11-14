<?php

use App\Http\Controllers\Api\V1\TourController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'v1.',
    'prefix' => 'v1',
    'middleware' => ['auth.partner'],
], function () {
    Route::get('tours', [TourController::class, 'index'])->name('tours');
    Route::get('tour/{tour:id}', [TourController::class, 'details'])->name('tour.details');
});
