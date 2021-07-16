<?php

use App\Http\Controllers\Admin\TourSubjects\TourSubjectsController;
use Illuminate\Support\Facades\Route;

Route::get('tour-subjects/{tourSubject}/media', [TourSubjectsController::class, 'mediaIndex'])->name('tour-subjects.media.index');
Route::post('tour-subjects/{tourSubject}/media', [TourSubjectsController::class, 'mediaUpload'])->name('tour-subjects.media.upload');
Route::delete('tour-subjects/{tourSubject}/media/{media}', [TourSubjectsController::class, 'mediaRemove'])->name('tour-subjects.media.destroy');

Route::resource('tour-subjects', TourSubjectsController::class)->except('show');
