<?php


use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Event\EventGroupController;

Route::patch('/events/{event}/update-status', [EventController::class, 'updateStatus'])->name('event.update-status');
Route::resource('event', EventController::class)->except('show');
Route::resource('event-group', EventGroupController::class)->except('show');
