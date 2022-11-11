<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourBasicRequest;
use App\Models\Badge;
use App\Models\Currency;
use App\Models\Direction;
use App\Models\EventItem;
use App\Models\Staff;
use App\Models\Tour;
use App\Models\TourGroup;
use App\Models\TourSubject;
use App\Models\TourType;
use App\Services\TourService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourController extends Controller
{
    protected $service;

    public function __construct(TourService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        return view('admin.tour.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $tour = new Tour();
        $tour->currency = 'UAH';
        $tour->locales = ['uk'];
        $currencies = Currency::toSelectBox('iso', 'iso');
        $badges = Badge::all();
        $guides = Staff::onlyExcursionLeaders()->get()->map->asSelectBox();
        $managers = Staff::onlyTourManagers()->get()->map->asSelectBox();
        $groups = TourGroup::toSelectBox();
        $events = EventItem::toSelectBox();
        $types = TourType::toSelectBox();
        $subjects = TourSubject::toSelectBox();
        $directions = Direction::toSelectBox();
        $durationFormats = [
            ['value' => Tour::FORMAT_DAYS, 'text' => __('Дні / Ночі')],
            ['value' => Tour::FORMAT_TIME, 'text' => __('Час')],
        ];

        return view('admin.tour.create', [
            'tour' => $tour,
            'currencies' => $currencies,
            'badges' => $badges,
            'guides' => $guides,
            'managers' => $managers,
            'groups' => $groups,
            'events' => $events,
            'types' => $types,
            'subjects' => $subjects,
            'directions' => $directions,
            'durationFormats' => $durationFormats,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TourBasicRequest  $request
     * @return Response
     *
     * @throws GeneralException
     */
    public function store(TourBasicRequest $request)
    {
        //
        $tour = $this->service->store($request->validated());

        if ($main_image_alts = $request->get('main_image_alts')) {
            $media = $tour->getFirstMedia('main');
            if ($media) {
                foreach ($main_image_alts as $locale => $alt) {
                    $media->setCustomProperty('alt_'.$locale, $alt);
                }
                $media->save();
            }
        }

        if ($main_image_titles = $request->get('main_image_titles')) {
            $media = $tour->getFirstMedia('main');
            if ($media) {
                foreach ($main_image_titles as $locale => $title) {
                    $media->setCustomProperty('title_'.$locale, $title);
                }
                $media->save();
            }
        }

        if ($mobile_image_alts = $request->get('mobile_image_alts')) {
            $media = $tour->getFirstMedia('mobile');
            if ($media) {
                foreach ($mobile_image_alts as $locale => $alt) {
                    $media->setCustomProperty('alt_'.$locale, $alt);
                }
                $media->save();
            }
        }

        if ($mobile_image_titles = $request->get('mobile_image_titles')) {
            $media = $tour->getFirstMedia('mobile');
            if ($media) {
                foreach ($mobile_image_titles as $locale => $title) {
                    $media->setCustomProperty('title_'.$locale, $title);
                }
                $media->save();
            }
        }

        return redirect()->route('admin.tour.picture.index', ['tour' => $tour])->withFlashSuccess(__('Record Created'));
    }

    public function show(Tour $tour)
    {
        return redirect()->route('admin.tour.edit', $tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tour  $tour
     * @return View
     */
    public function edit(Tour $tour)
    {
        //
        $tour->append(['plan']);
        $currencies = Currency::toSelectBox('iso', 'iso');
        $badges = Badge::all();
        $guides = Staff::onlyExcursionLeaders()->get()->map->asSelectBox();
        $managers = Staff::onlyTourManagers()->get()->map->asSelectBox();
        $groups = TourGroup::toSelectBox();
        $events = EventItem::toSelectBox();
        $types = TourType::toSelectBox();
        $subjects = TourSubject::toSelectBox();
        $directions = Direction::toSelectBox();
        $durationFormats = [
            ['value' => Tour::FORMAT_DAYS, 'text' => __('Дні / Ночі')],
            ['value' => Tour::FORMAT_TIME, 'text' => __('Час')],
        ];

        return view('admin.tour.edit', [
            'tour' => $tour,
            'currencies' => $currencies,
            'badges' => $badges,
            'guides' => $guides,
            'managers' => $managers,
            'groups' => $groups,
            'events' => $events,
            'types' => $types,
            'subjects' => $subjects,
            'directions' => $directions,
            'durationFormats' => $durationFormats,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Tour  $tour
     * @return Response
     */
    public function update(TourBasicRequest $request, Tour $tour)
    {
        //
        $this->service->update($tour, $request->validated());

        if ($main_image_alts = $request->get('main_image_alts')) {
            $media = $tour->getFirstMedia('main');
            if ($media) {
                foreach ($main_image_alts as $locale => $alt) {
                    $media->setCustomProperty('alt_'.$locale, $alt);
                }
                $media->save();
            }
        }

        if ($main_image_titles = $request->get('main_image_titles')) {
            $media = $tour->getFirstMedia('main');
            if ($media) {
                foreach ($main_image_titles as $locale => $title) {
                    $media->setCustomProperty('title_'.$locale, $title);
                }
                $media->save();
            }
        }

        if ($mobile_image_alts = $request->get('mobile_image_alts')) {
            $media = $tour->getFirstMedia('mobile');
            if ($media) {
                foreach ($mobile_image_alts as $locale => $alt) {
                    $media->setCustomProperty('alt_'.$locale, $alt);
                }
                $media->save();
            }
        }

        if ($mobile_image_titles = $request->get('mobile_image_titles')) {
            $media = $tour->getFirstMedia('mobile');
            if ($media) {
                foreach ($mobile_image_titles as $locale => $title) {
                    $media->setCustomProperty('title_'.$locale, $title);
                }
                $media->save();
            }
        }

        return redirect()->route('admin.tour.edit', $tour)->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tour  $tour
     * @return Response
     */
    public function destroy(Tour $tour)
    {
        //
        $tour->delete();

        return redirect()->route('admin.tour.index')->withFlashSuccess(__('Record Deleted'));
    }

    /**
     * Update status the specified resource.
     *
     * @param  Request  $request
     * @param  Tour  $tour
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Tour $tour)
    {
        $tour->published = (int) $request->input('published');
        $tour->save();

        return response()->json(['result' => 'Success']);
    }
}
