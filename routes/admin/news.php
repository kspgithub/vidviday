<?php


use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\News\NewsPictureController;

Route::group([
    'prefix' => 'news',
    'as' => 'news.',
], function() {

    Route::get('{news}/pictures', [NewsPictureController::class, 'index'])->name('picture.index');
    Route::post('{news}/pictures', [NewsPictureController::class, 'upload'])->name('picture.store');
    Route::patch('{news}/pictures/{media}', [NewsPictureController::class, 'update'])->name('picture.update');
    Route::delete('{news}/pictures/{media}', [NewsPictureController::class, 'delete'])->name('picture.destroy');
});

Route::resource("news", NewsController::class)->except('show');
