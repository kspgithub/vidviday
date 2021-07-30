<?php
use App\Http\Controllers\Admin\VacancyController;
use Illuminate\Support\Facades\Route;

Route::resource('vacancy', VacancyController::class);
