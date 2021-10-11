<?php

use App\Http\Controllers\TourGuide\TourGuideController;

//Route::get('/guides', [TourGuideController::class, 'index'])->name('guides');
Route::get('guide/{id}', [TourGuideController::class, 'show'])->name('guide');


