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

require_once __DIR__.'/frontend/auth.php';

// ADMIN ROUTES

Route::get('/admin/login', [LoginController::class, 'create'])->middleware('guest')->name('admin.login.create');
Route::post('/admin/login', [LoginController::class, 'store'])->middleware('guest')->name('admin.login.store');
Route::post('/admin/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('admin.logout');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth.admin',
], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    require_once __DIR__.'/admin/upload.php';
    require_once __DIR__.'/admin/user.php';
    require_once __DIR__.'/admin/translation.php';
    require_once __DIR__.'/admin/page.php';
    require_once __DIR__.'/admin/tour.php';
    require_once __DIR__.'/admin/tour_subjects.php';
    require_once __DIR__.'/admin/tour-group.php';
    require_once __DIR__.'/admin/direction.php';
    require_once __DIR__.'/admin/place.php';
    require_once __DIR__.'/admin/tour-type.php';
    require_once __DIR__.'/admin/country.php';
    require_once __DIR__.'/admin/region.php';
    require_once __DIR__.'/admin/city.php';
    require_once __DIR__.'/admin/faq.php';
    require_once __DIR__.'/admin/transport.php';
    require_once __DIR__.'/admin/badge.php';
    require_once __DIR__.'/admin/news.php';
    require_once __DIR__.'/admin/staff.php';
    require_once __DIR__.'/admin/vacancies.php';
    require_once __DIR__.'/admin/accommodation.php';

});

Route::get('{slug}', [PageController::class, 'show'])->name('page.show');
