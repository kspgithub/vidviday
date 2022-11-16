<?php


use App\Http\Controllers\Crm\CrmController;

Route::group([
    'prefix' => 'crm',
    'as' => 'crm.',
], function () {
    Route::post('/contact-update', [CrmController::class, 'contactUpdate'])->name('contact.update')
        ->middleware('auth.bitrix');
    Route::post('/deal-update', [CrmController::class, 'dealUpdate'])->name('deal.update')
        ->middleware('auth.bitrix');
    Route::any('/app-handler', [CrmController::class, 'appHandler'])->name('app.handler');
    Route::any('/app-install', [CrmController::class, 'appInstall'])->name('app.install');
    Route::get('/app-check-server', [CrmController::class, 'appCheckServer'])->name('app.check-server');
});

