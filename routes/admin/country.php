<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use Illuminate\Support\Facades\Route;

Route::resource('country', CountryController::class);

