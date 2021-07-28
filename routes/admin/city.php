<?php
use App\Http\Controllers\Admin\CityController;
use Illuminate\Support\Facades\Route;

Route::get('city/search', [CityController::class, 'search'])->name('city.search');
Route::resource('city', CityController::class);
