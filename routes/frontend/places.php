<?php

use App\Http\Controllers\Place\PlaceController;

Route::get('/places', [PlaceController::class, 'index'])->name('places');
Route::get('/place/{slug?}', [PlaceController::class, 'show'])->name('place.show');
Route::post('place/{place}/testimonial', [PlaceController::class, 'testimonial'])->name('place.testimonial');

