<?php

use App\Http\Controllers\Api\UserController;

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
], function () {
    Route::get('', [UserController::class, 'data'])->name('data');
    Route::post('feedback', [UserController::class, 'feedback'])->middleware(['throttle:6,1'])->name('feedback');
    Route::get('favourites', [UserController::class, 'favourites'])->name('favourites.index');
    Route::patch('favourites/{id}', [UserController::class, 'favouritesToggle'])->name('favourites.toggle');
});
