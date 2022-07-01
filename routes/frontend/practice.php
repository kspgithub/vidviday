<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Practice\PracticeController;

Route::get('/practices', [PracticeController::class, 'index'])->name('practice.index');
Route::get('/practice/{slug}', [PracticeController::class, 'show'])->name('practice.show');
