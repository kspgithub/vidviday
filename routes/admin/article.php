<?php


use App\Http\Controllers\Admin\Article\ArticleController;
use App\Http\Controllers\Admin\Article\ArticlePictureController;

Route::group([
    'prefix' => 'article',
    'as' => 'article.',
], function() {

    Route::get('{article}/pictures', [ArticlePictureController::class, 'index'])->name('picture.index');
    Route::post('{article}/pictures', [ArticlePictureController::class, 'upload'])->name('picture.store');
    Route::patch('{article}/pictures/{media}', [ArticlePictureController::class, 'update'])->name('picture.update');
    Route::delete('{article}/pictures/{media}', [ArticlePictureController::class, 'delete'])->name('picture.destroy');
});

Route::resource("article", ArticleController::class)->except('show');
