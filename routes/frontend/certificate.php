<?php


use App\Http\Controllers\Certificate\CertificateController;

Route::group([
    'prefix' => 'certificate',
    'as' => 'certificate.',
], function () {
    // Route::get('', [CertificateController::class, 'index'])->name('index'); // этот роут обрабатывается в PageController
    Route::get('/order', [CertificateController::class, 'order'])->name('order');
    Route::post('/order', [CertificateController::class, 'orderStore'])->name('order.store');
    Route::get('/order/{order}/success', [CertificateController::class, 'orderSuccess'])->name('order.success');
});

