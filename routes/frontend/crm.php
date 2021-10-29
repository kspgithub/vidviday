<?php


use App\Http\Controllers\Crm\CrmController;

Route::group([
    'prefix' => 'crm',
    'as' => 'crm.',
    'middleware' => 'auth.bitrix',
], function () {
    Route::post('/contact-update', [CrmController::class, 'contactUpdate'])->name('contact.update');
    Route::post('/deal-update', [CrmController::class, 'dealUpdate'])->name('deal.update');
});

