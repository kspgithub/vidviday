<?php

use App\Http\Controllers\Staff\StaffController;

//Route::get('office-workers', [StaffController::class, 'index'])->name('office-workers');
Route::get('office-worker/{id}', [StaffController::class, 'show'])->name('office-worker');
Route::post('staff/{staff}', [StaffController::class, 'testimonial'])->name('staff.testimonial');


