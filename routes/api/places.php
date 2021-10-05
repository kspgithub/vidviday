<?php


use App\Http\Controllers\Api\PlacesController;

Route::group([
    'as' => 'places.',
    'prefix' => 'places',
], function () {

    Route::get('select-box', [PlacesController::class, 'selectBox'])->name('select-box');

});
