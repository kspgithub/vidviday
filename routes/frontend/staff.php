<?php

use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\TourGuide\TourGuideController;

//Route::get('office-workers', [StaffController::class, 'index'])->name('office-workers');
Route::get('guide/{slug}', [TourGuideController::class, 'show'])->name('guide.show');
Route::get('office-worker/{slug}', [StaffController::class, 'show'])->name('staff.show');
Route::post('staff/{staff}', [StaffController::class, 'testimonial'])->name('staff.testimonial');


