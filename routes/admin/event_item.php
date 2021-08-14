<?php


use App\Http\Controllers\Admin\EventItem\EventItemController;
use Illuminate\Support\Facades\Route;

Route::get('event-item/{eventItem}/media', [EventItemController::class, 'mediaIndex'])->name('event-item.media.index');
Route::resource('event-item', EventItemController::class)->except('show');
