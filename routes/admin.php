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

use App\Http\Controllers\Admin\Achievement\AchievementController;
use App\Http\Controllers\Admin\Advertisement\AdvertisementController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Finance\FinanceController;
use App\Http\Controllers\Admin\Food\FoodController;
use App\Http\Controllers\Admin\OurClient\OurClientController;
use App\Http\Controllers\Admin\SiteMenu\MenuItemController;
use App\Http\Controllers\Admin\SiteOptionsController;
use App\Http\Controllers\Admin\Testimonial\TestimonialController;

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
require_once base_path('routes/admin/price_item.php');
require_once base_path('routes/admin/include_type.php');
require_once base_path('routes/admin/tour_include.php');
require_once base_path('routes/admin/blog.php');
require_once base_path('routes/admin/order.php');
require_once base_path('routes/admin/location.php');
require_once base_path('routes/admin/site-menu.php');

Route::resource('badge', BadgeController::class)->except('show');
Route::resource('food', FoodController::class)->except('show');
Route::resource('finance', FinanceController::class)->except('show');
Route::resource('banner', BannerController::class)->except('show');
Route::resource('advertisement', AdvertisementController::class)->except('show');
Route::resource('achievement', AchievementController::class)->except('show');
Route::resource('our-client', OurClientController::class)->except('show');

Route::get('site-options', [SiteOptionsController::class, 'index'])->name('site-options.index');
Route::patch('site-options', [SiteOptionsController::class, 'update'])->name('site-options.update');

Route::get('edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::patch('update', [ContactController::class, 'update'])->name('contact.update');

Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonial.index');
Route::get('questions', [TestimonialController::class, 'questions'])->name('testimonial.questions');


