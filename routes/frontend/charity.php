<?php


use App\Http\Controllers\Charity\CharityController;

Route::get("/charity", [CharityController::class, "index"])->name("charity.index");
Route::get("/charity/{slug}", [CharityController::class, "single"])->name("charity.single");
