<?php


use App\Http\Controllers\Vacancy\VacancyController;

Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('vacancy.show');
