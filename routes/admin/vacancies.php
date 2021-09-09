<?php

use App\Http\Controllers\Admin\Vacancy\VacancyController;
use Illuminate\Support\Facades\Route;

Route::resource('vacancy', VacancyController::class);
