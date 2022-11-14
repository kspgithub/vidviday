<?php

use App\Http\Controllers\Practice\PracticeController;
use Illuminate\Support\Facades\Route;

Route::get('/practices', [PracticeController::class, 'index'])->name('practice.index');
Route::get('/practice/{slug}', [PracticeController::class, 'show'])->name('practice.show');
