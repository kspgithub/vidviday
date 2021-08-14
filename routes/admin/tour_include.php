<?php


use App\Http\Controllers\Admin\TourInclude\TourIncludeController;

Route::resource("tour-include", TourIncludeController::class)->except('show');
