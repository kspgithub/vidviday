<?php

use App\Http\Controllers\Faq\FaqController;

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
