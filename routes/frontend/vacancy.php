<?php


use App\Http\Controllers\Vacancy\VacancyController;

Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancy.index');
Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('vacancy.show');
