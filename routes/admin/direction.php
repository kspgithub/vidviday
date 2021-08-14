<?php

use App\Http\Controllers\Admin\Direction\DirectionController;
use Illuminate\Support\Facades\Route;

Route::get('direction/{direction}/media', [DirectionController::class, 'mediaIndex'])->name('direction.media.index');
Route::post('direction/{direction}/media', [DirectionController::class, 'mediaUpload'])->name('direction.media.upload');
Route::delete('direction/{direction}/media/{media}', [DirectionController::class, 'mediaRemove'])
    ->name('direction.media.destroy');

Route::resource('direction', DirectionController::class);
