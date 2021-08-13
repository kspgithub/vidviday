<?php


use App\Http\Controllers\Admin\SiteMenu\MenuController;
use App\Http\Controllers\Admin\SiteMenu\MenuItemController;


Route::resource("menu", MenuController::class)->except('show');


Route::resource("menu-item", MenuItemController::class)->except('show');
