<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\RegionController;

Route::resource('country', CountryController::class);

Route::resource('region', RegionController::class);

Route::get('district/search', [DistrictController::class, 'search'])->name('district.search');
Route::resource('district', DistrictController::class);

Route::get('city/search', [CityController::class, 'search'])->name('city.search');
Route::resource('city', CityController::class);

