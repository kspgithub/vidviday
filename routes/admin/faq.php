<?php

use App\Http\Controllers\Admin\Faq\FaqController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'faq',
    'as' => 'faqitem.',
], function () {
    Route::get('{section?}', [FaqController::class, 'index'])->name('index');
    Route::get('{section}/create', [FaqController::class, 'create'])->name('create');
    Route::post('{section}/create', [FaqController::class, 'store'])->name('store');
    Route::get('{section}/{faqItem}', [FaqController::class, 'edit'])->name('edit');
    Route::patch('{section}/{faqItem}', [FaqController::class, 'update'])->name('update');
    Route::delete('{section}/{faqItem}', [FaqController::class, 'destroy'])->name('destroy');
});
