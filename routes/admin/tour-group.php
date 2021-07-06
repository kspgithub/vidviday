<?php


use App\Http\Controllers\Admin\TourGroup\TourGroupController;
use Illuminate\Support\Facades\Route;

Route::get('tour-group/{tourGroup}/media', [TourGroupController::class, 'mediaIndex'])->name('tour-group.media.index');
Route::resource('tour-group', TourGroupController::class)->except('show');
