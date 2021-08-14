<?php


use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Event\EventDirectionController;
use App\Http\Controllers\Admin\Event\EventGroupController;
use App\Http\Controllers\Admin\Event\EventPictureController;


;

Route::group([
    'prefix' => 'event',
    'as' => 'event.',
], function() {

    Route::get('{event}/pictures', [EventPictureController::class, 'index'])->name('picture.index');
    Route::post('{event}/pictures', [EventPictureController::class, 'upload'])->name('picture.store');
    Route::patch('{event}/pictures/{media}', [EventPictureController::class, 'update'])->name('picture.update');
    Route::delete('{event}/pictures/{media}', [EventPictureController::class, 'delete'])->name('picture.destroy');


    Route::get('{event}/groups', [EventGroupController::class, 'index'])->name('group.index');
    Route::patch('{event}/groups', [EventGroupController::class, 'update'])->name('group.update');

    Route::get('{event}/directions', [EventDirectionController::class, 'index'])->name('direction.index');
    Route::patch('{event}/directions', [EventDirectionController::class, 'update'])->name('direction.update');
});

Route::resource("event", EventController::class)->except('show');
