<?php

use App\Http\Controllers\PageController;

Route::get('{slug}', [PageController::class, 'show'])->name('page.show');
