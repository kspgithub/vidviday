<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
//Route::get('/test-error', [HomeController::class, 'testError'])->name('test-error');

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
require base_path('routes/frontend/vacancy.php');
require base_path('routes/frontend/crm.php');


//Route::get('/mail/html', function () {
//    return view('emails.registration', ['user' => User::find(8), 'showFooter' => true, 'password' => 'sdfsdf']);
//});
// ADMIN ROUTES
/*
 * see admin.php
 */
