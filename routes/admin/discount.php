<?php


use App\Http\Controllers\Admin\Discount\DiscountController;

Route::resource("discount", DiscountController::class)->except('show');
