<?php

use App\Http\Controllers\Admin\Tour\TourAccommController;
use App\Http\Controllers\Admin\Tour\TourController;
use App\Http\Controllers\Admin\Tour\TourDirectionController;
use App\Http\Controllers\Admin\Tour\TourFoodController;
use App\Http\Controllers\Admin\Tour\TourGroupController;
use App\Http\Controllers\Admin\Tour\TourPictureController;
use App\Http\Controllers\Admin\Tour\TourPlacesController;
use App\Http\Controllers\Admin\Tour\TourScheduleController;
use App\Http\Controllers\Admin\Tour\TourSubjectController;
use App\Http\Controllers\Admin\Tour\TourTypeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'tour',
    'as' => 'tour.',
], function () {
    Route::get('{tour}/pictures', [TourPictureController::class, 'index'])->name('picture.index');
    Route::post('{tour}/pictures', [TourPictureController::class, 'upload'])->name('picture.store');
    Route::patch('{tour}/pictures/{media}', [TourPictureController::class, 'update'])->name('picture.update');
    Route::delete('{tour}/pictures/{media}', [TourPictureController::class, 'delete'])->name('picture.destroy');

    Route::get('{tour}/groups', [TourGroupController::class, 'index'])->name('group.index');
    Route::patch('{tour}/groups', [TourGroupController::class, 'update'])->name('group.update');

    Route::get('{tour}/places', [TourPlacesController::class, 'index'])->name('places.index');
    Route::patch('{tour}/places', [TourPlacesController::class, 'update'])->name('places.update');
    
    Route::get('{tour}/subjects', [TourSubjectController::class, 'index'])->name('subject.index');
    Route::patch('{tour}/subjects', [TourSubjectController::class, 'update'])->name('subject.update');

    Route::get('{tour}/types', [TourTypeController::class, 'index'])->name('type.index');
    Route::patch('{tour}/types', [TourTypeController::class, 'update'])->name('type.update');

    Route::get('{tour}/directions', [TourDirectionController::class, 'index'])->name('direction.index');
    Route::patch('{tour}/directions', [TourDirectionController::class, 'update'])->name('direction.update');


    Route::get('{tour}/schedule', [TourScheduleController::class, 'index'])->name('schedule.index');

    Route::patch('{tour}/update-status', [TourController::class, 'updateStatus'])->name('update-status');
});

Route::resource('tour', TourController::class);

Route::resource('tour.food', TourFoodController::class)->except('show');

Route::resource('tour.accomm', TourAccommController::class)->except('show');
