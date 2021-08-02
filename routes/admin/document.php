<?php


use App\Http\Controllers\Admin\Document\DocumentController;

Route::resource("document", DocumentController::class)->except('show');
