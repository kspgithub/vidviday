<?php

use App\Http\Controllers\Purchase\PurchaseController;

Route::group([
    'as' => 'purchase.',
], function () {


    Route::match(['get', 'post'],'purchase/service', [PurchaseController::class, 'service'])->name('service');

});
