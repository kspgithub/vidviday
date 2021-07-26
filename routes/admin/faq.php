<?php
use App\Http\Controllers\Admin\FaqController;
use Illuminate\Support\Facades\Route;

Route::resource('faqitem', FaqController::class);
