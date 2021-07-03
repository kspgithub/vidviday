<?php


use App\Http\Controllers\Admin\Tour\TourController;
use Illuminate\Support\Facades\Route;

Route::resource('tour', TourController::class);
