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

use App\Http\Controllers\Admin\Accommodation\AccommodationController;
use App\Http\Controllers\Admin\Accommodation\AccommodationTypeController;
use App\Http\Controllers\Admin\Achievement\AchievementController;
use App\Http\Controllers\Admin\Advertisement\AdvertisementController;
use App\Http\Controllers\Admin\Broker\OrderBrokerController;
use App\Http\Controllers\Admin\CRM\CrmBrokerController;
use App\Http\Controllers\Admin\Email\EmailTemplateController;
use App\Http\Controllers\Admin\Partner\PartnerController;
use App\Http\Controllers\Admin\PopupAds\PopupAdsController;
use App\Http\Controllers\Admin\Badge\BadgeController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Certificate\CertificateController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\CRM\CrmCertificateController;
use App\Http\Controllers\Admin\CRM\CrmClientController;
use App\Http\Controllers\Admin\CRM\CrmCorporateController;
use App\Http\Controllers\Admin\CRM\CrmNotificationsController;
use App\Http\Controllers\Admin\CRM\CrmOrderController;
use App\Http\Controllers\Admin\CRM\CrmScheduleController;
use App\Http\Controllers\Admin\CRM\CrmTransportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Direction\DirectionController;
use App\Http\Controllers\Admin\Discount\DiscountController;
use App\Http\Controllers\Admin\Document\DocumentController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Event\EventGroupController;
use App\Http\Controllers\Admin\Faq\FaqController;
use App\Http\Controllers\Admin\Finance\FinanceController;
use App\Http\Controllers\Admin\Food\FoodController;
use App\Http\Controllers\Admin\HtmlBlock\HtmlBlockController;
use App\Http\Controllers\Admin\IncludeType\IncludeTypeController;
use App\Http\Controllers\Admin\LandingPlace\LandingPlaceController;
use App\Http\Controllers\Admin\Location\CityController;
use App\Http\Controllers\Admin\Location\CountryController;
use App\Http\Controllers\Admin\Location\DistrictController;
use App\Http\Controllers\Admin\Location\RegionController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\Charity\CharityController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\OurClient\OurClientController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Place\PlaceController;
use App\Http\Controllers\Admin\PriceItem\PriceItemController;
use App\Http\Controllers\Admin\Recommendation\RecommendationController;
use App\Http\Controllers\Admin\RedirectsController;
use App\Http\Controllers\Admin\SiteMenu\MenuItemController;
use App\Http\Controllers\Admin\SiteOptionsController;
use App\Http\Controllers\Admin\Staff\StaffController;
use App\Http\Controllers\Admin\Staff\StaffTypeController;
use App\Http\Controllers\Admin\Testimonial\QuestionTypesController;
use App\Http\Controllers\Admin\Testimonial\TestimonialController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\TourGroup\TourGroupController;
use App\Http\Controllers\Admin\TourInclude\TourIncludeController;
use App\Http\Controllers\Admin\Tours\PopularToursController;
use App\Http\Controllers\Admin\TourSubjects\TourSubjectsController;
use App\Http\Controllers\Admin\TourType\TourTypeController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\Transport\OrderTransportController;
use App\Http\Controllers\Admin\Transport\TransportController;
use App\Http\Controllers\Admin\Transport\TransportDurationController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\User\DeactivatedUserController;
use App\Http\Controllers\Admin\User\DeletedUserController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserPasswordController;
use App\Http\Controllers\Admin\Vacancy\VacancyController;
use App\Http\Controllers\Admin\Practice\PracticeController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\WrongRequestsController;
use Illuminate\Support\Facades\Route;

Route::get('', [DashboardController::class, 'index'])->name('dashboard');

// MEDIA LIBRARY
Route::post('editor/upload', [UploadController::class, 'editor'])->name('editor.upload');
Route::post('media/upload', [UploadController::class, 'mediaStore'])->name('media.store');
Route::post('media/order', [UploadController::class, 'mediaOrder'])->name('media.order');
Route::patch('media/{media}', [UploadController::class, 'mediaUpdate'])->name('media.update');
Route::delete('media/{media}', [UploadController::class, 'mediaDelete'])->name('media.destroy');

// SITE TRANSLATIONS
Route::group([
    'prefix' => 'translation',
    'as' => 'translation.',
], function () {
    Route::get('', [TranslationController::class, 'index'])->name('index');
    Route::get('create', [TranslationController::class, 'create'])->name('create');
    Route::post('create', [TranslationController::class, 'store'])->name('store');
    Route::get('{line}/edit', [TranslationController::class, 'edit'])->name('edit');
    Route::patch('{line}', [TranslationController::class, 'update'])->name('update');
    Route::delete('{line}', [TranslationController::class, 'destroy'])->name('destroy');
    Route::post('publish', [TranslationController::class, 'publish'])->name('publish');
});

// SITE USERS
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/create', [UserController::class, 'store'])->name('store');

    Route::get('deleted', [DeletedUserController::class, 'index'])->name('deleted');
    Route::get('deactivated', [DeactivatedUserController::class, 'index'])->name('deactivated');

    Route::get('{user}', [UserController::class, 'show'])->name('show');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('{user}', [UserController::class, 'update'])->name('update');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::patch('{user}/mark/{status}', [DeactivatedUserController::class, 'update'])->name('mark')->where(['status' => '[0,1]']);

    Route::get('{user}/password/change', [UserPasswordController::class, 'edit'])->name('change-password');
    Route::patch('{user}/password/change', [UserPasswordController::class, 'update'])->name('change-password.update');

    Route::group(['prefix' => '{deletedUser}'], function () {
        Route::patch('restore', [DeletedUserController::class, 'update'])->name('restore');
        Route::delete('permanently-delete', [DeletedUserController::class, 'destroy'])->name('permanently-delete');
    });
});


// FAQ
Route::group([
    'prefix' => 'faq',
    'as' => 'faqitem.',
], function () {
    Route::post('sort', [FaqController::class, 'sort'])->name('sort');
    Route::get('{section?}', [FaqController::class, 'index'])->name('index');
    Route::get('{section}/create', [FaqController::class, 'create'])->name('create');
    Route::post('{section}/create', [FaqController::class, 'store'])->name('store');
    Route::get('{section}/{faqItem}', [FaqController::class, 'edit'])->name('edit');
    Route::patch('{section}/{faqItem}', [FaqController::class, 'update'])->name('update');
    Route::delete('{section}/{faqItem}', [FaqController::class, 'destroy'])->name('destroy');
});

// TRANSPORT
Route::resource('transport', TransportController::class);
Route::resource('transport_duration', TransportDurationController::class);
Route::resource('order-transport', OrderTransportController::class)->only(['index', 'show', 'edit', 'update']);

// BROKER
Route::resource('order-broker', OrderBrokerController::class)->only(['index', 'show', 'edit', 'update']);

// NEWS
Route::patch('news/{news}/update-status', [NewsController::class, 'updateStatus'])->name('news.update-status');
Route::resource('news', NewsController::class)->except('show');

// Charity
Route::patch('charity/{charity}/update-status', [CharityController::class, 'updateStatus'])->name('charity.update-status');
Route::resource('charity', CharityController::class)->except('show');

// BLOG
Route::patch('post/{post}/update-status', [PostController::class, 'updateStatus'])->name('post.update-status');
Route::resource("post", PostController::class)->except('show');

// VACANCY
Route::resource('vacancy', VacancyController::class)->except('show');

// Practice
Route::resource('practice', PracticeController::class)->except('show');

// Course
Route::resource('course', CourseController::class)->except('show');

// ACCOMMODATION
Route::patch('accommodation/{accommodation}/update-status', [AccommodationController::class, 'updateStatus'])
    ->name('accommodation.update-status');
Route::resource('accommodation', AccommodationController::class);
Route::resource('accommodation-type', AccommodationTypeController::class);

// DOCUMENTS
Route::patch('document/{document}/update-status', [DocumentController::class, 'updateStatus'])->name('document.update-status');
Route::resource("document", DocumentController::class)->except('show');

// TICKETS
Route::patch('ticket/{ticket}/update-status', [TicketController::class, 'updateStatus'])->name('ticket.update-status');
Route::resource('ticket', TicketController::class)->except('show');

// EVENTS
Route::patch('/events/{event}/update-status', [EventController::class, 'updateStatus'])->name('event.update-status');
Route::resource('event', EventController::class)->except('show');
Route::resource('event-group', EventGroupController::class)->except('show');

// TOUR INCLUDE
Route::resource("include-type", IncludeTypeController::class)->except('show');
Route::resource("tour-include", TourIncludeController::class)->except('show');

// ORDERS
Route::patch('order/{order}/update-status', [OrderController::class, 'updateStatus'])->name('order.update-status');
Route::patch('order/{order}/accomm', [OrderController::class, 'accomm'])->name('order.accom');
Route::resource('order', OrderController::class);
Route::resource('certificate', CertificateController::class);

// LOCATION
Route::resource('country', CountryController::class)->except('show');

Route::resource('region', RegionController::class)->except('show');

Route::get('district/search', [DistrictController::class, 'search'])->name('district.search');
Route::resource('district', DistrictController::class)->except('show');

Route::get('city/search', [CityController::class, 'search'])->name('city.search');
Route::resource('city', CityController::class)->except('show');

// SITE MENU
Route::group([
    'prefix' => 'site-menu',
    'as' => 'site-menu.',
], function () {
    Route::get('', [MenuItemController::class, 'index'])->name('index');
    Route::post('sort', [MenuItemController::class, 'sort'])->name('item.sort');
    Route::get('{menu}/create', [MenuItemController::class, 'create'])->name('item.create');
    Route::post('{menu}/create', [MenuItemController::class, 'store'])->name('item.store');
    Route::get('{item}/edit', [MenuItemController::class, 'edit'])->name('item.edit');
    Route::patch('{item}/edit', [MenuItemController::class, 'update'])->name('item.update');
    Route::patch('{item}/status', [MenuItemController::class, 'status'])->name('item.status');
    Route::delete('{item}/delete', [MenuItemController::class, 'destroy'])->name('item.destroy');
});


// TESTIMONIALS AND QUESTIONS
Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonial.index');
Route::get('testimonials/{testimonial}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
Route::patch('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonial.update');
Route::get('questions', [TestimonialController::class, 'questions'])->name('testimonial.questions');
Route::get('questions/{testimonial}', [TestimonialController::class, 'editQuestion'])->name('testimonial.questions.edit');
Route::patch('questions/{testimonial}', [TestimonialController::class, 'updateQuestion'])->name('testimonial.questions.update');
Route::get('user_questions', [TestimonialController::class, 'userQuestions'])->name('testimonial.user_questions');
Route::get('user_questions/{testimonial}', [TestimonialController::class, 'editUserQuestion'])->name('testimonial.user_questions.edit');
Route::patch('user_questions/{testimonial}', [TestimonialController::class, 'updateUserQuestion'])->name('testimonial.user_questions.update');
Route::get('user_subscriptions', [TestimonialController::class, 'userSubscriptions'])->name('testimonial.user_subscriptions');
Route::patch('user_subscriptions/{testimonial}', [TestimonialController::class, 'updateUserSubscription'])->name('testimonial.user_subscriptions.update');
Route::get('agency_subscriptions', [TestimonialController::class, 'agencySubscriptions'])->name('testimonial.agency_subscriptions');
Route::patch('agency_subscriptions/{testimonial}', [TestimonialController::class, 'updateAgencySubscription'])->name('testimonial.agency_subscriptions.update');
// QUESTION TYPES
Route::resource('question_types', QuestionTypesController::class);

// CONTACTS
Route::get('contacts', [ContactsController::class, 'edit'])->name('contact.edit');
Route::patch('contacts', [ContactsController::class, 'update'])->name('contact.update');

// SITE OPTIONS
Route::get('site-options', [SiteOptionsController::class, 'index'])->name('site-options.index');
Route::patch('site-options', [SiteOptionsController::class, 'update'])->name('site-options.update');

// REDIRECTS
Route::get('redirects', [RedirectsController::class, 'index'])->name('redirects.index');
Route::patch('redirects', [RedirectsController::class, 'update'])->name('redirects.update');

// STAFF
Route::resource('staff-type', StaffTypeController::class)->except(['show']);
Route::resource('staff', StaffController::class)->except('show');

// OTHER RESOURCE
Route::resource('html-block', HtmlBlockController::class)->except('show');

Route::post('page/recommendation/sort', [RecommendationController::class, 'sort'])->name('page.recommendation.sort');
Route::resource('page', PageController::class)->except(['show']);

Route::resource('page.recommendation', RecommendationController::class)->except(['show']);
Route::resource('banner', BannerController::class)->except('show');
Route::patch('banner/{banner}/update-status', [BannerController::class, 'updateStatus'])->name('banner.update-status');
Route::resource('advertisement', AdvertisementController::class)->except('show');
Route::resource('popup_ads', PopupAdsController::class)->except('show');
Route::patch('popup_ads/{popupAd}/add_rule', [PopupAdsController::class, 'addRule'])->name('popup-ads.add-rule');
Route::delete('popup_ads/{popup_ad}/remove_rule', [PopupAdsController::class, 'removeRule'])->name('popup-ads.remove-rule');
Route::resource('achievement', AchievementController::class)->except('show');
Route::resource('our-client', OurClientController::class)->except('show');

// TOUR
Route::resource('place', PlaceController::class)->except('show');
Route::resource('food', FoodController::class)->except('show');
Route::resource('finance', FinanceController::class)->except('show');
Route::resource('price-item', PriceItemController::class)->except('show');
Route::resource('discount', DiscountController::class)->except('show');
Route::resource('badge', BadgeController::class)->except('show');
Route::resource('tour-type', TourTypeController::class)->except('show');
Route::resource('direction', DirectionController::class)->except('show');
Route::resource('tour-subjects', TourSubjectsController::class)->except('show');
Route::resource('tour-group', TourGroupController::class)->except('show');
Route::resource('landing-place', LandingPlaceController::class)->except('show');
Route::resource('popular-tours', PopularToursController::class)->except(['show', 'edit']);
Route::post('popular-tours/sort', [PopularToursController::class, 'sort'])->name('popular-tours.sort');

require_once base_path('routes/admin/tour.php');


Route::group([
    'prefix' => 'crm',
    'as' => 'crm.',
], function () {
    Route::get('clients', [CrmClientController::class, 'index'])->name('client.index');
    Route::get('clients/{client}/{type?}', [CrmClientController::class, 'show'])->name('client.show');
    Route::post('clients', [CrmClientController::class, 'store'])->name('client.store');
    Route::patch('clients/{client}', [CrmClientController::class, 'update'])->name('client.update');
    Route::delete('clients/{client}', [CrmClientController::class, 'delete'])->name('client.destroy');


    Route::get('schedules', [CrmScheduleController::class, 'index'])->name('schedule.index');
    Route::get('schedules/{schedule}', [CrmScheduleController::class, 'show'])->name('schedule.show');
    Route::patch('schedules/{schedule}', [CrmScheduleController::class, 'update'])->name('schedule.update');
    Route::post('schedules/{schedule}/info_sheet', [CrmScheduleController::class, 'uploadInfoSheet'])->name('schedule.upload_info_sheet');
    Route::get('schedules/{schedule}/order/{order}', [CrmScheduleController::class, 'order'])->name('schedule.order.show');
    Route::get('schedules/{schedule}/order/{order}', [CrmScheduleController::class, 'order'])->name('schedule.order.show');

    Route::post('notify/email', [CrmNotificationsController::class, 'notifyEmail'])->name('notify.email.send');

    Route::get('transport/count', [CrmTransportController::class, 'count'])->name('transport.count');
    Route::get('broker/count', [CrmBrokerController::class, 'count'])->name('broker.count');

    Route::get('certificate/count', [CrmCertificateController::class, 'count'])->name('certificate.count');

    Route::get('order/{order}/audits', [CrmOrderController::class, 'audits'])->name('order.audits');
    Route::get('order/count', [CrmOrderController::class, 'count'])->name('order.count');

    Route::resource('order', CrmOrderController::class);
    Route::resource('corporate', CrmCorporateController::class)->parameters([
        'corporate' => 'order'
    ]);
});

Route::get('email-templates', [EmailTemplateController::class, 'index'])->name('email-templates.index');
Route::get('email-templates/{template}', [EmailTemplateController::class, 'edit'])->name('email-templates.edit');
Route::get('email-templates/{template}/preview', [EmailTemplateController::class, 'preview'])->name('email-templates.preview');
Route::delete('email-templates/{template}', [EmailTemplateController::class, 'reset'])->name('email-templates.reset');
Route::patch('email-templates/{template}', [EmailTemplateController::class, 'save'])->name('email-templates.save');

Route::resource('partner', PartnerController::class)->except(['show']);

Route::get('wrong_requests', [WrongRequestsController::class, 'index'])->name('wrong_requests.index');
