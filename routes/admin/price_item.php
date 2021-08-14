<?php


use App\Http\Controllers\Admin\PriceItem\PriceItemController;

Route::resource("price-item", PriceItemController::class)->except('show');
