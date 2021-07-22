<?php
use App\Http\Controllers\Admin\BadgeController;
use Illuminate\Support\Facades\Route;

Route::resource('badge', BadgeController::class);
