<?php

use App\Http\Controllers\Admin\Place\PlaceController;
use Illuminate\Support\Facades\Route;

Route::resource('place', PlaceController::class)->except('show');
