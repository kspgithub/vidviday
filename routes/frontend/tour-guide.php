<?php

use App\Http\Controllers\TourGuide\TourGuideController;

Route::get('/tour-guides', [TourGuideController::class, 'index'])->name('tour-guides');
Route::get('tour-guide/{id}', [TourGuideController::class, 'more'])->name('tour-guide');


