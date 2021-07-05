<?php

use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('editor/upload', [UploadController::class, 'editor'])->name('editor.upload');

Route::post('media/upload', [UploadController::class, 'mediaStore'])->name('media.store');
Route::patch('media/{media}', [UploadController::class, 'mediaUpdate'])->name('media.update');
Route::delete('media/{media}', [UploadController::class, 'mediaDelete'])->name('media.destroy');

