<?php


use App\Http\Controllers\Profile\ProfileController;

Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'middleware' => 'auth',
], function() {
    Route::get('', [ProfileController::class, 'index'])->name('index');
    Route::get('orders', [ProfileController::class, 'orders'])->name('orders');
    Route::get('history', [ProfileController::class, 'history'])->name('history');
    Route::get('favourites', [ProfileController::class, 'favourites'])->name('favourites');
});
