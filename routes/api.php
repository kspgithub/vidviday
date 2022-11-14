<?php

use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\LandingsController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\PlacesController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\ToursController;
use App\Http\Controllers\Api\UserController;
use App\Models\HtmlBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require_once base_path('routes/api/v1.php');

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
], function () {
    Route::get('', [UserController::class, 'data'])->name('data');
    Route::post('feedback', [UserController::class, 'feedback'])->middleware(['throttle:6,1'])->name('feedback');
    Route::post('subscription', [UserController::class, 'subscription'])->middleware(['throttle:6,1'])->name('subscription');
    Route::post('agent-subscription', [UserController::class, 'agentSubscription'])->middleware(['throttle:6,1'])->name('agent-subscription');
    Route::get('favourites', [UserController::class, 'favourites'])->name('favourites.index');
    Route::patch('favourites/{id}', [UserController::class, 'favouritesToggle'])->name('favourites.toggle');
});

Route::group([
    'as' => 'calendar.',
    'prefix' => 'calendar',
], function () {
    Route::get('events', [CalendarController::class, 'events'])->name('events');
});

Route::group([
    'as' => 'tours.',
    'prefix' => 'tours',
], function () {
    Route::get('', [ToursController::class, 'index'])->name('index');
    Route::get('popular', [ToursController::class, 'popular'])->name('popular');
    Route::get('autocomplete', [ToursController::class, 'autocomplete'])->name('autocomplete');
    Route::get('guides', [ToursController::class, 'guides'])->name('guides');
    Route::get('select-box', [ToursController::class, 'selectBox'])->name('select-box');
    Route::get('{tour}/schedules', [ToursController::class, 'schedules'])->name('schedules');
    Route::get('{tourId}/all-schedules', [ToursController::class, 'allSchedules'])->name('all-schedules');
});

Route::group([
    'as' => 'places.',
    'prefix' => 'places',
], function () {
    Route::get('select-box', [PlacesController::class, 'selectBox'])->name('select-box');
    Route::get('find', [PlacesController::class, 'show'])->name('show');
    Route::get('get', [PlacesController::class, 'get'])->name('get');
});

Route::group([
    'as' => 'search.',
    'prefix' => 'search',
], function () {
    Route::get('autocomplete', [SearchController::class, 'autocomplete'])->name('autocomplete');
});

Route::group([
    'as' => 'accommodations.',
    'prefix' => 'accommodations',
], function () {
    Route::get('select-box', [AccommodationController::class, 'selectBox'])->name('select-box');
});

Route::group([
    'as' => 'landings.',
    'prefix' => 'landings',
], function () {
    Route::get('select-box', [LandingsController::class, 'selectBox'])->name('select-box');
    Route::get('find', [LandingsController::class, 'show'])->name('show');
    Route::get('get', [LandingsController::class, 'get'])->name('get');
});

Route::group([
    'as' => 'tickets.',
    'prefix' => 'tickets',
], function () {
    Route::get('select-box', [TicketsController::class, 'selectBox'])->name('select-box');
    Route::get('get', [TicketsController::class, 'get'])->name('get');
});

Route::group([
    'as' => 'location.',
    'prefix' => 'location',
], function () {
    Route::get('countries', [LocationController::class, 'countries'])->name('countries');
    Route::get('regions', [LocationController::class, 'regions'])->name('regions');
    Route::get('districts', [LocationController::class, 'districts'])->name('districts');
    Route::get('cities', [LocationController::class, 'cities'])->name('cities');
    Route::get('places', [LocationController::class, 'places'])->name('places');
});

Route::get('html-blocks', function (Request $request) {
    $q = Str::lower($request->input('q', ''));
    $htmlBlocks = HtmlBlock::query()
        ->orWhere('slug', 'like', '%'.$q.'%')
        ->orWhere('title', 'like', '%'.$q.'%')
        ->get();

    return response()->json([
        'results' => $htmlBlocks->map(fn ($html) => [
            'id' => $html->slug,
            'text' => $html->title,
        ])->toArray(),
    ]);
});
