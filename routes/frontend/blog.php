<?php

use App\Http\Controllers\BlogController;

Route::get("/blog", [BlogController::class, "index"])->name("blogs");

Route::get("/post/{slug}", [BlogController::class, "show"])->name("post");
