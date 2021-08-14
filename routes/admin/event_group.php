<?php


use App\Http\Controllers\Admin\EventGroup\EventGroupController;
use Illuminate\Support\Facades\Route;

Route::get('event-group/{eventGroup}/media', [EventGroupController::class, 'mediaIndex'])
      ->name('event-group.media.index');
Route::resource('event-group', EventGroupController::class)->except('show');
