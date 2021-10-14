<?php


use App\Http\Controllers\Certificate\CertificateController;

Route::group([
    'prefix' => 'certificate',
    'as' => 'certificate.',
], function () {
    Route::get('/order', [CertificateController::class, 'order'])->name('order');
});

