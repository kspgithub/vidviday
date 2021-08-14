<?php

use App\Http\Controllers\Admin\HomePageBanner\HomePageBannerController;
use App\Http\Controllers\Admin\HomePageBanner\HomePageBannerPictureController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'home-page-banner',
    'as' => 'home-page-banner.',
], function () {
    Route::get('{homePageBanner}/pictures', [HomePageBannerPictureController::class, 'index'])->name('picture.index');
    Route::post('{homePageBanner}/pictures', [HomePageBannerPictureController::class, 'upload'])->name('picture.store');
    Route::patch('{homePageBanner}/pictures/{media}', [HomePageBannerPictureController::class, 'update'])
        ->name('picture.update');
    Route::delete('{homePageBanner}/pictures/{media}', [HomePageBannerPictureController::class, 'delete'])
        ->name('picture.destroy');
});

Route::resource('home-page-banner', HomePageBannerController::class)->except('show');
