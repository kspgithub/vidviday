<?php

use App\Http\Controllers\Blog\BlogController;

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'post'])->name('blog.post');
