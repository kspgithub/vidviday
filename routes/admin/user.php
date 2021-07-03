<?php

use App\Http\Controllers\Admin\User\DeactivatedUserController;
use App\Http\Controllers\Admin\User\DeletedUserController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserPasswordController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');

    Route::get('deleted', [DeletedUserController::class, 'index'])->name('deleted');
    Route::get('deactivated', [DeactivatedUserController::class, 'index'])->name('deactivated');

    Route::get('{user}', [UserController::class, 'show'])->name('show');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('{user}', [UserController::class, 'update'])->name('update');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::patch('{user}/mark/{status}', [DeactivatedUserController::class, 'update'])->name('mark')->where(['status' => '[0,1]']);

    Route::get('{user}/password/change', [UserPasswordController::class, 'edit'])->name('change-password');
    Route::patch('{user}/password/change', [UserPasswordController::class, 'update'])->name('change-password.update');

    Route::group(['prefix' => '{deletedUser}'], function () {
        Route::patch('restore', [DeletedUserController::class, 'update'])->name('restore');
        Route::delete('permanently-delete', [DeletedUserController::class, 'destroy'])->name('permanently-delete');
    });
});
