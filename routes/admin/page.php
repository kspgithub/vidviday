<?php

use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::get('page/{page}/media', [PageController::class, 'mediaIndex'])->name('page.media.index');

Route::resource('page', PageController::class);
