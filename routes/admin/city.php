<?php
//dd(1);
use App\Http\Controllers\Admin\CityController;
use Illuminate\Support\Facades\Route;

Route::resource('city', CityController::class);
