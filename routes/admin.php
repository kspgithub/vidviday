<?php

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Finance\FinanceController;
use App\Http\Controllers\Admin\Food\FoodController;
use App\Http\Controllers\Admin\SiteOptionsController;

Route::get('', [DashboardController::class, 'index'])->name('dashboard');

require_once base_path('routes/admin/dashboard.php');
require_once base_path('routes/admin/upload.php');
require_once base_path('routes/admin/user.php');
require_once base_path('routes/admin/translation.php');
require_once base_path('routes/admin/page.php');
require_once base_path('routes/admin/tour.php');
require_once base_path('routes/admin/tour_subjects.php');
require_once base_path('routes/admin/tour-group.php');
require_once base_path('routes/admin/direction.php');
require_once base_path('routes/admin/place.php');
require_once base_path('routes/admin/tour-type.php');
require_once base_path('routes/admin/faq.php');
require_once base_path('routes/admin/transport.php');
require_once base_path('routes/admin/badge.php');
require_once base_path('routes/admin/news.php');
require_once base_path('routes/admin/staff.php');
require_once base_path('routes/admin/vacancies.php');
require_once base_path('routes/admin/accommodation.php');
require_once base_path('routes/admin/document.php');
require_once base_path('routes/admin/ticket.php');
require_once base_path('routes/admin/html_block.php');
require_once base_path('routes/admin/discount.php');
require_once base_path('routes/admin/staff-type.php');
require_once base_path('routes/admin/event.php');
require_once base_path('routes/admin/event_group.php');
require_once base_path('routes/admin/event_item.php');
require_once base_path('routes/admin/home_page_banner.php');
require_once base_path('routes/admin/price_item.php');
require_once base_path('routes/admin/include_type.php');
require_once base_path('routes/admin/tour_include.php');
require_once base_path('routes/admin/contact.php');
require_once base_path('routes/admin/blog.php');
require_once base_path('routes/admin/order.php');
require_once base_path('routes/admin/location.php');

Route::resource("food", FoodController::class)->except('show');
Route::resource("finance", FinanceController::class)->except('show');

Route::get('site-options', [SiteOptionsController::class, 'index'])->name('site-options.index');
Route::patch('site-options', [SiteOptionsController::class, 'update'])->name('site-options.update');
