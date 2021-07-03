<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('page/{page}/media', [PageController::class, 'mediaIndex'])->name('page.media.index');
Route::post('page/{page}/media', [PageController::class, 'mediaUpload'])->name('page.media.upload');
Route::delete('page/{page}/media/{media}', [PageController::class, 'mediaRemove'])->name('page.media.destroy');

Route::resource('page', PageController::class);

Route::post('editor/upload', [UploadController::class, 'editor'])
    ->name('editor.upload');
