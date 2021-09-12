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
require_once base_path('routes/admin/country.php');
require_once base_path('routes/admin/region.php');
require_once base_path('routes/admin/city.php');
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
require_once base_path('routes/admin/tour_plan.php');
require_once base_path('routes/admin/blog.php');
