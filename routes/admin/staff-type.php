<?php
use App\Http\Controllers\Admin\StaffTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('staff-type', StaffTypeController::class);
