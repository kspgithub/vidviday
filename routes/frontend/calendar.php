<?php

use App\Http\Controllers\CalendarController;

Route::group([
    'prefix' => 'calendar',
    'as' => 'calendar.',
], function() {
    Route::get('', [CalendarController::class, 'index'])->name('index');
});
