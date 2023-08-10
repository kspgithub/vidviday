<?php


use App\Http\Controllers\Profile\ProfileController;

Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'middleware' => 'auth',
], function() {
    Route::get('', [ProfileController::class, 'index'])->name('index');
    Route::patch('', [ProfileController::class, 'update'])->name('update');
    Route::get('orders', [ProfileController::class, 'orders'])->name('orders');
    Route::post('orders/add-note', [ProfileController::class, 'addNote'])->name('add-note');
    Route::get('history', [ProfileController::class, 'history'])->name('history');
    Route::get('favourites', [ProfileController::class, 'favourites'])->name('favourites');
    Route::get('delete-account', [ProfileController::class, 'deleteAccount'])->name('delete.ask');
    Route::delete('delete-account', [ProfileController::class, 'confirmDelete'])->name('delete.confirm');
});
Route::get('successfully-deleted', [ProfileController::class, 'successfullyDeleted'])->name('delete.successfully-deleted');
