<?php

use App\Http\Controllers\Admin\Accommodation\AccommodationController;
use App\Http\Controllers\Admin\Accommodation\AccommodationTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('accommodation', AccommodationController::class);
Route::resource('accommodation-type', AccommodationTypeController::class);

Route::group([
    'prefix' => 'accommodation',
    'as' => 'accommodation.',
], function () {
    Route::patch('{accommodation}/update-status', [AccommodationController::class, 'updateStatus'])->name('update-status');

});
