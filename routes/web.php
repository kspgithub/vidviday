<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// SITE ROUTES

Route::get('/', [HomeController::class, 'index'])->name('home');

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

require_once __DIR__.'/frontend/auth.php';

// ADMIN ROUTES

Route::get('/admin/login', [LoginController::class, 'create'])->middleware('guest')->name('admin.login.create');
Route::post('/admin/login', [LoginController::class, 'store'])->middleware('guest')->name('admin.login.store');
Route::post('/admin/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('admin.logout');

Route::group([
    'prefix' => 'admin',
    'as'=>'admin.',
    'middleware' => 'auth.admin',
], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    require_once __DIR__.'/admin/auth.php';
    require_once __DIR__.'/admin/user.php';
    require_once __DIR__.'/admin/translation.php';
    require_once __DIR__.'/admin/page.php';
});
