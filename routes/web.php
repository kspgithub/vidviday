<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\CurrencyController;
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

Route::get('currency/{currency}', [CurrencyController::class, 'change'])->name('currency.change');

require base_path('routes/frontend/profile.php');
require base_path('routes/frontend/tour.php');
require base_path('routes/frontend/staff.php');
require base_path('routes/frontend/news.php');
require base_path('routes/frontend/guide.php');
require base_path('routes/frontend/event.php');
require base_path('routes/frontend/places.php');
require base_path('routes/frontend/transport.php');
require base_path('routes/frontend/corporate.php');
require base_path('routes/frontend/order.php');
require base_path('routes/frontend/faq.php');
require base_path('routes/frontend/testimonial.php');
require base_path('routes/frontend/document.php');
require base_path('routes/frontend/blog.php');
require base_path('routes/frontend/certificate.php');

// ADMIN ROUTES
/*
 * see admin.php
 */
