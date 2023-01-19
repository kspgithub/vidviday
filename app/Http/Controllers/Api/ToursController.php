<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\SearchEventsRequest;
use App\Http\Requests\Tour\SearchToursRequest;
use App\Models\Staff;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Services\TourService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Str;

class ToursController extends Controller
{
    //

    /**
     * Поиск туров по параметрам
     * @param SearchToursRequest $request
     * @return JsonResponse
     */
    public function index(SearchToursRequest $request)
    {
        $future = (int)$request->input('future', 1) !== 0;

        $query = Tour::search($future)->filter($request->validated());



        $prev = trim(url()->previous(), '/');

        if($prev === route('home')) {
            $query->where('home_disabled', '!=', true);
        }

        $query->withCount([
            'testimonials' => function ($q) {
                return $q->moderated()
                    ->orderBy('rating', 'desc')
                    ->latest();
            },
        ]);

        $votingsCountIncluded = false;

        /** @var Expression|string $column */
        foreach ($query->getQuery()->columns as $column) {
            if($column instanceof Expression && Str::contains($column->getValue(), 'votings_count')) {
                $votingsCountIncluded = true;
            }
        }

        if(!$votingsCountIncluded) {
            $query->withCount(['votings' => fn($q) => $q->published() ]);
        }

        $paginator = $query->paginate($request->input('per_page', 12));

        $result = $paginator->toArray();



        $result['request_title'] = TourService::searchRequestTitle($request->validated());

        return response()->json($result);
    }

    /**
     * Популярные туры
     * @param Request $request
     * @return Tour[]|
     */
    public function popular(Request $request)
    {
        $locale = $request->input('locale', getLocale());
        return TourService::popularTours(null, $request->input('count', 12), $locale);
    }

    /**
     * Поиск туров по названию (автокомплит)
     * @param Request $request
     * @return mixed
     */
    public function autocomplete(Request $request)
    {
        $q = $request->input('q', '');
        $limit = $request->input('limit', 20);
        if ($limit == 0) {
            $limit = 1000;
        }
        return Tour::filter($request->all())->take($limit)->get()->map->shortInfo();
    }

    /**
     * Расписание тура
     * @param Request $request
     * @param Tour $tour
     * @return mixed
     */
    public function schedules(SearchEventsRequest $request, Tour $tour)
    {
        return $tour->schedulesForBooking($request->validated());
    }


    /**
     * Поиск туров по названию (selectbox)
     * @param Request $request
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = $request->input('q', '');

        $query = Tour::search()->autocomplete($q);
        $relations = $request->input('relations', []);
        $attributes = $request->input('attributes', []);

        if (!empty($relations)) {
            $query->with($relations);
        }
        $paginator = $query->paginate($request->input('limit', 10));

        $paginator->getCollection()->transform(function (Tour $tour) use ($relations, $attributes) {
            $value = $tour->asSelectBox();
            if (!empty($relations)) {
                foreach ($relations as $relation) {
                    $value[$relation] = $tour->getRelation($relation);
                }
            }
            if (!empty($attributes)) {
                foreach ($attributes as $attribute) {
                    $value[$attribute] = $tour->getAttribute($attribute);
                }
            }
            return $value;
        });

        $items = $paginator->items();
        return [
            'results' => $items,
            'pagination' => [
                'more' => $paginator->hasMorePages()
            ]
        ];
    }


    public function guides(Request $request)
    {
        $guidesQuery = Staff::onlyExcursionLeaders();
        $tour_id = $request->input('tour_id', 0);
        if ($tour_id > 0) {
            $guidesQuery->whereHas('tours', fn($q) => $q->where('id', $tour_id));
        }
        return $guidesQuery->orderBy('last_name')->get(['id', 'first_name', 'last_name', 'phone', 'email', 'avatar']);
    }

    /**
     * Расписание тура (для админки)
     * @param Request $request
     * @param Tour $tour
     * @return mixed
     */
    public function allSchedules($tourId)
    {
        $tour = Tour::findOrFail($tourId);
        return $tour->scheduleItems()->orderBy('start_date', 'desc')->get()->map->shortInfo();
    }
}
