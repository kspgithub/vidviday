<?php


use App\Http\Controllers\Admin\Ticket\TicketController;

Route::resource("ticket", TicketController::class)->except('show');

Route::group([
    'prefix' => 'ticket',
    'as' => 'ticket.',
], function () {
    Route::patch('{ticket}/update-status', [TicketController::class, 'updateStatus'])->name('update-status');
});

