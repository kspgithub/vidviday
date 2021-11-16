<?php


use App\Http\Controllers\Admin\SiteMenu\MenuItemController;

Route::get('site-menu', [MenuItemController::class, 'index'])->name('site-menu.index');
Route::post('site-menu/sort', [MenuItemController::class, 'sort'])->name('site-menu.item.sort');
Route::get('site-menu/{menu}/create', [MenuItemController::class, 'create'])->name('site-menu.item.create');
Route::post('site-menu/{menu}/create', [MenuItemController::class, 'store'])->name('site-menu.item.store');
Route::get('site-menu/{item}/edit', [MenuItemController::class, 'edit'])->name('site-menu.item.edit');
Route::patch('site-menu/{item}/edit', [MenuItemController::class, 'update'])->name('site-menu.item.update');
Route::patch('site-menu/{item}/status', [MenuItemController::class, 'status'])->name('site-menu.item.status');
Route::delete('site-menu/{item}/delete', [MenuItemController::class, 'destroy'])->name('site-menu.item.destroy');
