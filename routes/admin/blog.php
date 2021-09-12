<?php


use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Blog\BlogPictureController;

Route::group([
    'prefix' => 'blog',
    'as' => 'blog.',
], function() {

    Route::get('{blog}/pictures', [BlogPictureController::class, 'index'])->name('picture.index');
    Route::post('{blog}/pictures', [BlogPictureController::class, 'upload'])->name('picture.store');
    Route::patch('{blog}/pictures/{media}', [BlogPictureController::class, 'update'])->name('picture.update');
    Route::delete('{blog}/pictures/{media}', [BlogPictureController::class, 'delete'])->name('picture.destroy');
});

Route::resource("blog", BlogController::class)->except('show');
