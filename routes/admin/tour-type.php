<?php


use App\Http\Controllers\Admin\TourType\TourTypeController;
use Illuminate\Support\Facades\Route;

Route::get('tour-type/{tourType}/media', [TourTypeController::class, 'mediaIndex'])->name('tour-type.media.index');
Route::resource('tour-type', TourTypeController::class)->except('show');
