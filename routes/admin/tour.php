<?php

use App\Http\Controllers\Admin\Tour\TourController;
use App\Http\Controllers\Admin\Tour\TourPictureController;
use App\Http\Controllers\Admin\Tour\TourSubjectsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'tour',
    'as' => 'tour.',
], function() {
    Route::get('{tour}/pictures', [TourPictureController::class, 'index'])->name('picture.index');
    Route::post('{tour}/pictures', [TourPictureController::class, 'upload'])->name('picture.store');
    Route::patch('{tour}/pictures/{media}', [TourPictureController::class, 'update'])->name('picture.update');
    Route::delete('{tour}/pictures/{media}', [TourPictureController::class, 'delete'])->name('picture.destroy');
});

Route::resource('tour', TourController::class);

Route::resource('tour-subjects', TourSubjectsController::class);
