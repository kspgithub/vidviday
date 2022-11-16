<?php


use App\Http\Controllers\Purchase\PurchaseController;

Route::group([
    'as' => 'purchase.',
], function () {


    Route::post('purchase/service', [PurchaseController::class, 'service'])->name('service');

});
