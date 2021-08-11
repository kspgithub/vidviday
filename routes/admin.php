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

require base_path('routes/admin/dashboard.php');
require base_path('routes/admin/upload.php');
require base_path('routes/admin/user.php');
require base_path('routes/admin/translation.php');
require base_path('routes/admin/page.php');
require base_path('routes/admin/tour.php');
require base_path('routes/admin/tour_subjects.php');
require base_path('routes/admin/tour-group.php');
require base_path('routes/admin/direction.php');
require base_path('routes/admin/place.php');
require base_path('routes/admin/tour-type.php');
require base_path('routes/admin/country.php');
require base_path('routes/admin/region.php');
require base_path('routes/admin/city.php');
require base_path('routes/admin/faq.php');
require base_path('routes/admin/transport.php');
require base_path('routes/admin/badge.php');
require base_path('routes/admin/news.php');
require base_path('routes/admin/staff.php');
require base_path('routes/admin/vacancies.php');
require base_path('routes/admin/accommodation.php');
require base_path('routes/admin/document.php');
require base_path('routes/admin/ticket.php');
require base_path('routes/admin/html_block.php');
require base_path('routes/admin/discount.php');
require base_path('routes/admin/staff-type.php');
