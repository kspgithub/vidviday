<?php


use App\Http\Controllers\Course\CourseController;

Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/{slug}', [CourseController::class, 'show'])->name('course.show');
