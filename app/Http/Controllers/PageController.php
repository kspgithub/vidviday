<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Broker\BrokerController;
use App\Http\Controllers\Certificate\CertificateController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\Place\PlaceController;
use App\Http\Controllers\Practice\PracticeController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Testimonial\TestimonialController;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\TourGuide\TourGuideController;
use App\Http\Controllers\Transport\TransportController;
use App\Http\Controllers\TravelAgent\TravelAgentController;
use App\Http\Controllers\Vacancy\VacancyController;
use App\Models\EventItem;
use App\Models\Page;
use App\Models\Place;
use App\Models\PopupAd;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\VisualOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Storage;

class PageController extends Controller
{
    //
    public function show(Request $request, $slug)
    {
        $giftImage = VisualOption::where('key', 'gift_image')->first();
        View::share('giftImage', $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg');

        if (EventItem::existBySlug($slug, false)) {
            return (new EventController())->show($slug);
        }

        if (Tour::existBySlug($slug, false)) {
            return (new TourController())->show($slug);
        }

        if (Place::existBySlug($slug, false)) {
            return (new PlaceController())->show($slug);
        }

        $tourGroup = TourGroup::findBySlug($slug, false);
        if ($tourGroup !== null) {
            $tourGroup->checkSlugLocale($slug);
            return (new TourController())->index($request, $tourGroup);
        }

        $pageContent = Page::query()->where('published', 1)->whereHasSlug($slug, false)->firstOrFail();

        if(!$pageContent->isAvailableFor($request->user())) {
            abort(404);
        }

        $pageContent->checkSlugLocale($slug);
        $localeLinks = $pageContent->getLocaleLinks();

        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        // todo: pageContent, localeLinks & popupAds are shared to View. No need to fetch it again in certain page controller. (e.g. TourGuideController:19)
        View::share('pageContent', $pageContent);
        View::share('localeLinks', $localeLinks);
        View::share('popupAds', $popupAds);
        

        switch ($pageContent->key) {
            case 'home':
                return redirect('/?lang=' . getLocale(), 301);
            case 'guides':
                return (new TourGuideController())->index($request);
            case 'office-workers':
                return (new StaffController())->index($request);
            case 'certificate':
                return (new CertificateController())->index($request);
            case 'events':
                return (new EventController())->index($request);
            case 'transport':
                return (new TransportController())->index($request);
            case 'broker':
                return (new BrokerController())->index($request);
            case 'for-travel-agents':
                return (new TravelAgentController())->index($request);
            case 'vacancies':
                return (new VacancyController())->index($request);
            case 'praktyka':
                return (new PracticeController())->index($request);
            case 'schools':
                return (new SchoolController())->index($request);
            case 'our-documents':
                return (new DocumentController())->index($request);
            case 'our-contacts':
                return (new ContactController())->index($request);
            case 'testimonials':
                return (new TestimonialController())->index($request);
            case 'courses':
                return (new CourseController())->index($request);
            case 'faq':
                return (new FaqController())->index($request);
            case 'calendar':
                return (new CalendarController())->index($request);
            default:
                return view('page.show', []);
        }


    }
}
