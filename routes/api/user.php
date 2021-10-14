<?php

use App\Http\Controllers\Api\UserController;

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
], function () {
    Route::get('', [UserController::class, 'data'])->name('data');
    Route::post('feedback', [UserController::class, 'feedback'])->middleware(['throttle:6,1'])->name('feedback');
});
