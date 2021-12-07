<?php

use App\Http\Controllers\Place\PlaceController;

Route::get('/places', [PlaceController::class, 'index'])->name('places');
Route::post('place/{place}/testimonial', [PlaceController::class, 'testimonial'])->name('place.testimonial');

