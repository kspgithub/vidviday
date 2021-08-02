<?php


use App\Http\Controllers\Admin\Ticket\TicketController;

Route::resource("ticket", TicketController::class)->except('show');
