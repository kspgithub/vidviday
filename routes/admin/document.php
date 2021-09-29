<?php


use App\Http\Controllers\Admin\Document\DocumentController;

Route::resource("document", DocumentController::class)->except('show');

Route::group([
    'prefix' => 'document',
    'as' => 'document.',
], function () {
    Route::patch('{document}/update-status', [DocumentController::class, 'updateStatus'])->name('update-status');
});

