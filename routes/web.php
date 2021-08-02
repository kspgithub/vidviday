<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
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



// ADMIN ROUTES
/*
 * see admin.php
 */
