<?php

use App\Http\Controllers\Document\DocumentController;

Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
