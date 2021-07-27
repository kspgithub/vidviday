<?php

use App\Http\Controllers\Admin\TransportController;
use Illuminate\Support\Facades\Route;

Route::get('transport/{transport}/media', [TransportController::class, 'mediaIndex'])->name('transport.media.index');
Route::post('transport/{transport}/media', [TransportController::class, 'mediaUpload'])->name('transport.media.upload');
Route::delete('transport/{transport}/media/{media}', [TransportController::class, 'mediaRemove'])->name('transport.media.destroy');

Route::resource('transport', TransportController::class);
