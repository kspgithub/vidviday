<?php


use App\Http\Controllers\Admin\TourPlan\TourPlanController;

Route::resource("tour-plan", TourPlanController::class)->except('show');
