<?php

use App\Http\Controllers\Api\UserController;

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
], function () {
    Route::get('', [UserController::class, 'data'])->name('data');
    Route::post('feedback', [UserController::class, 'feedback'])->middleware(['throttle:6,1'])->name('feedback');
    Route::post('subscription', [UserController::class, 'subscription'])->middleware(['throttle:6,1'])->name('subscription');
    Route::post('agent-subscription', [UserController::class, 'agentSubscription'])->middleware(['throttle:6,1'])->name('agent-subscription');
    Route::get('favourites', [UserController::class, 'favourites'])->name('favourites.index');
    Route::patch('favourites/{id}', [UserController::class, 'favouritesToggle'])->name('favourites.toggle');
});
