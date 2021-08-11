<?php

use App\Http\Controllers\Admin\Staff\StaffController;
use Illuminate\Support\Facades\Route;

Route::resource('staff', StaffController::class);
