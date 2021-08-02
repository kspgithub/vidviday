<?php

use App\Http\Controllers\Admin\Accommodation\AccommodationController;
use App\Http\Controllers\Admin\Accommodation\AccommodationTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('accommodation', AccommodationController::class);
Route::resource('accommodation-type', AccommodationTypeController::class);
