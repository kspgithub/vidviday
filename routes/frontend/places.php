<?php

use App\Http\Controllers\Place\PlaceController;

Route::get('/places', [PlaceController::class, 'index'])->name('places');
Route::get('/place/{slug?}', [PlaceController::class, 'more'])->name('place');


