<?php

use App\Http\Controllers\BlogController;

Route::get("/blog", [BlogController::class, "index"])->name("blog.index");

Route::get("/blog/{slug}", [BlogController::class, "single"])->name("blogs.single");
