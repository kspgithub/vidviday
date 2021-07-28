<?php

use App\Http\Controllers\Admin\Place\PlaceController;
use Illuminate\Support\Facades\Route;

Route::get('place/{place}/media', [PlaceController::class, 'mediaIndex'])->name('place.media.index');
Route::resource('place', PlaceController::class)->except('show');
