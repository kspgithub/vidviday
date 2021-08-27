<?php


use App\Http\Controllers\News\NewsController;

Route::get("/blog", [NewsController::class, "blog"])->name("blog");
Route::get("/post/{slug}", [NewsController::class, "post"])->name("post");
