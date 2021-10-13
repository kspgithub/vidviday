<?php

use App\Http\Controllers\Api\UserController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
], function () {
    Route::post('feedback', [UserController::class, 'feedback'])->middleware(['throttle:6,1'])->name('feedback');
});
