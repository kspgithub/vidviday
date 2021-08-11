<?php
use App\Http\Controllers\Admin\Staff\StaffTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('staff-type', StaffTypeController::class)->except(['show']);
