<?php
use App\Http\Controllers\Admin\BadgeController;
use Illuminate\Support\Facades\Route;

Route::get('badge/{badge}/media', [BadgeController::class, 'mediaIndex'])->name('badge.media.index');
Route::post('badge/{badge}/media', [BadgeController::class, 'mediaUpload'])->name('badge.media.upload');
Route::delete('badge/{badge}/media/{media}', [BadgeController::class, 'mediaRemove'])->name('badge.media.destroy');

Route::resource('badge', BadgeController::class);
