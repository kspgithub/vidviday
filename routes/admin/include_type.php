<?php


use App\Http\Controllers\Admin\IncludeType\IncludeTypeController;

Route::resource("include-type", IncludeTypeController::class)->except('show');
