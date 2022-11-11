<?php

use App\Http\Controllers\News\NewsController;

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'single'])->name('news.single');
