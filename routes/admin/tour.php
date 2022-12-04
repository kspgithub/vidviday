<?php

use App\Http\Controllers\Admin\Tour\CalcController;
use App\Http\Controllers\Admin\Tour\HutsulFunController;
use App\Http\Controllers\Admin\Tour\SimilarToursController;
use App\Http\Controllers\Admin\Tour\TourAccommController;
use App\Http\Controllers\Admin\Tour\TourController;
use App\Http\Controllers\Admin\Tour\TourCorporateIncludesController;
use App\Http\Controllers\Admin\Tour\TourDirectionController;
use App\Http\Controllers\Admin\Tour\TourDiscountController;
use App\Http\Controllers\Admin\Tour\TourFoodController;
use App\Http\Controllers\Admin\Tour\TourGroupController;
use App\Http\Controllers\Admin\Tour\TourPictureController;
use App\Http\Controllers\Admin\Tour\TourPlacesController;
use App\Http\Controllers\Admin\Tour\TourPlanController;
use App\Http\Controllers\Admin\Tour\TourQuestionsController;
use App\Http\Controllers\Admin\Tour\TourScheduleController;
use App\Http\Controllers\Admin\Tour\TourSubjectController;
use App\Http\Controllers\Admin\Tour\TourTicketController;
use App\Http\Controllers\Admin\Tour\TourTransportController;
use App\Http\Controllers\Admin\Tour\TourTypeController;
use App\Http\Controllers\Admin\Tour\TourFinanceController;
use App\Http\Controllers\Admin\Tour\TourLandingController;
use App\Http\Controllers\Admin\Tour\TourVotingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'tour',
    'as' => 'tour.',
], function () {
    Route::get('{tour}/pictures', [TourPictureController::class, 'index'])->name('picture.index');

    Route::get('{tour}/groups', [TourGroupController::class, 'index'])->name('group.index');
    Route::patch('{tour}/groups', [TourGroupController::class, 'update'])->name('group.update');

    Route::get('{tour}/places', [TourPlacesController::class, 'index'])->name('places.index');
    Route::get('{tour}/places/create', [TourPlacesController::class, 'create'])->name('places.create');
    Route::post('{tour}/places', [TourPlacesController::class, 'store'])->name('places.store');
    Route::get('{tour}/places/{model}', [TourPlacesController::class, 'edit'])->name('places.edit');
    Route::patch('{tour}/places/{model}', [TourPlacesController::class, 'update'])->name('places.update');

    Route::get('{tour}/subjects', [TourSubjectController::class, 'index'])->name('subject.index');
    Route::patch('{tour}/subjects', [TourSubjectController::class, 'update'])->name('subject.update');

    Route::get('{tour}/types', [TourTypeController::class, 'index'])->name('type.index');
    Route::patch('{tour}/types', [TourTypeController::class, 'update'])->name('type.update');

    Route::get('{tour}/directions', [TourDirectionController::class, 'index'])->name('direction.index');
    Route::patch('{tour}/directions', [TourDirectionController::class, 'update'])->name('direction.update');


    Route::get('{tour}/schedule', [TourScheduleController::class, 'index'])->name('schedule.index');
    Route::post('{tour}/schedule', [TourScheduleController::class, 'store'])->name('schedule.store');
    Route::patch('{tour}/schedule/{schedule}', [TourScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('{tour}/schedule/{schedule}', [TourScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::patch('{tour}/update-status', [TourController::class, 'updateStatus'])->name('update-status');
    Route::patch('{tour}/update-tabs/{tab?}', [TourController::class, 'updateActiveTabs'])->name('update-tabs');

    Route::get('{tour}/discounts', [TourDiscountController::class, 'index'])->name('discount.index');

    Route::get('{tour}/plan', [TourPlanController::class, 'index'])->name('plan.index');
    Route::patch('{tour}/plan', [TourPlanController::class, 'update'])->name('plan.update');

    Route::get('{tour}/hutsul-fun', [HutsulFunController::class, 'index'])->name('hutsul-fun.index');
    Route::patch('{tour}/hutsul-fun', [HutsulFunController::class, 'update'])->name('hutsul-fun.update');

    Route::get('{tour}/finance', [TourFinanceController::class, 'index'])->name('finance.index');
    Route::get('{tour}/finance/create', [TourFinanceController::class, 'create'])->name('finance.create');
    Route::post('{tour}/finance', [TourFinanceController::class, 'store'])->name('finance.store');
    Route::get('{tour}/finance/{model}', [TourFinanceController::class, 'edit'])->name('finance.edit');
    Route::patch('{tour}/finance/{model}', [TourFinanceController::class, 'update'])->name('finance.update');

    Route::get('{tour}/similar', [SimilarToursController::class, 'index'])->name('similar.index');

    Route::get('{tour}/food', [TourFoodController::class, 'index'])->name('food.index');

    Route::get('{tour}/ticket', [TourTicketController::class, 'index'])->name('ticket.index');
    Route::get('{tour}/ticket/create', [TourTicketController::class, 'create'])->name('ticket.create');
    Route::post('{tour}/ticket', [TourTicketController::class, 'store'])->name('ticket.store');
    Route::get('{tour}/ticket/{model}', [TourTicketController::class, 'edit'])->name('ticket.edit');
    Route::patch('{tour}/ticket/{model}', [TourTicketController::class, 'update'])->name('ticket.update');

    Route::get('{tour}/faq', [TourQuestionsController::class, 'faq'])->name('faq');
    Route::get('{tour}/questions', [TourQuestionsController::class, 'questions'])->name('questions');
    Route::get('{tour}/testimonials', [TourQuestionsController::class, 'testimonials'])->name('testimonials');
    Route::get('{tour}/calc', [CalcController::class, 'index'])->name('calc');
    Route::get('{tour}/accomm', [TourAccommController::class, 'index'])->name('accomm.index');
    Route::get('{tour}/transport', [TourTransportController::class, 'index'])->name('transport.index');

    Route::get('{tour}/landing', [TourLandingController::class, 'index'])->name('landing.index');
    Route::get('{tour}/landing/create', [TourLandingController::class, 'create'])->name('landing.create');
    Route::post('{tour}/landing', [TourLandingController::class, 'store'])->name('landing.store');
    Route::get('{tour}/landing/{model}', [TourLandingController::class, 'edit'])->name('landing.edit');
    Route::patch('{tour}/landing/{model}', [TourLandingController::class, 'update'])->name('landing.update');

    Route::get('{tour}/corporate_includes', [TourCorporateIncludesController::class, 'index'])->name('corporate_includes.index');
    Route::post('{tour}/corporate_includes', [TourCorporateIncludesController::class, 'save'])->name('corporate_includes.save');

    Route::get('{tour}/voting', [TourVotingController::class, 'index'])->name('voting.index');
});

Route::resource('tour', TourController::class);
