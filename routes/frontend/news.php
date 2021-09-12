<?php


use App\Http\Controllers\News\NewsController;

Route::get("/news", [NewsController::class, "index"])->name("news");
Route::get("/single/{slug}", [NewsController::class, "single"])->name("news.single");
