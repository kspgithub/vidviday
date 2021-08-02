<?php


use App\Http\Controllers\Admin\HtmlBlock\HtmlBlockController;

Route::resource("html-block", HtmlBlockController::class)->except('show');
