<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Certificate\CertificateController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\Event\EventController;
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
use App\Models\Page;
use App\Models\Place;
use App\Models\Tour;
use App\Models\TourGroup;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function show(Request $request, $slug)
    {


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

        $pageContent->checkSlugLocale($slug);
        $localeLinks = $pageContent->getLocaleLinks();

        switch ($pageContent->key) {
            case 'home':
                return redirect('/?lang=' . getLocale(), 301);
            case 'guides':
                return (new TourGuideController())->index();
            case 'office-workers':
                return (new StaffController())->index();
            case 'certificate':
                return (new CertificateController())->index();
            case 'events':
                return (new EventController())->index();
            case 'transport':
                return (new TransportController())->index($request);
            case 'for-travel-agents':
                return (new TravelAgentController())->index($request);
            case 'vacancies':
                return (new VacancyController())->index($request);
            case 'practice':
                return (new PracticeController())->index($request);
            case 'schools':
                return (new SchoolController())->index($request);
            case 'our-documents':
                return (new DocumentController())->index($request);
            case 'testimonials':
                return (new TestimonialController())->index($request);
            default:
                return view('page.show', ['pageContent' => $pageContent, 'localeLinks' => $localeLinks]);
        }


    }
}
