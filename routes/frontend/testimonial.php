<?php

use App\Http\Controllers\Testimonial\TestimonialController;

Route::group([
    'prefix' => 'testimonials',
    'as' => 'testimonials.',
], function () {
    Route::get('', [TestimonialController::class, 'index'])->name('index');
    Route::post('', [TestimonialController::class, 'store'])->name('store');
    Route::patch('/answer', [TestimonialController::class, 'answer'])->name('answer');
    Route::get('{testimonial}/children', [TestimonialController::class, 'children'])->name('children');
});
