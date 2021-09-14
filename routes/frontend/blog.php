<?php

use App\Http\Controllers\BlogController;

Route::get("/blog", [BlogController::class, "index"])->name("blogs");

Route::get("/blog/{slug}", [BlogController::class, "single"])->name("blogs.single");
