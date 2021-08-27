<?php

use App\Http\Controllers\TourGuide\TourGuideController;

Route::get('/guides', [TourGuideController::class, 'index'])->name('guides');
Route::get('tour-guide/{slug?}', [TourGuideController::class, 'more'])->name('tour-guide');


