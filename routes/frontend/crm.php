<?php


use App\Http\Controllers\Crm\CrmController;

Route::group([
    'prefix' => 'crm',
    'as' => 'crm.',
], function () {
    Route::post('/contact-update', [CrmController::class, 'contactUpdate'])->name('contact.update');
});

