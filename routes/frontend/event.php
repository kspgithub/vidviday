<?php

use App\Http\Controllers\Event\EventController;

Route::get('/events', [EventController::class, 'index'])->name('events');



