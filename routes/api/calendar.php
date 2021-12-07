<?php


use App\Http\Controllers\Api\CalendarController;

Route::group([
    'as'=>'calendar.',
    'prefix'=>'calendar',
], function() {
    Route::get('events', [CalendarController::class, 'events'])->name('events');
});
