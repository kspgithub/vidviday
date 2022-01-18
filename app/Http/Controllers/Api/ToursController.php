<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\SearchEventsRequest;
use App\Http\Requests\Tour\SearchToursRequest;
use App\Models\Staff;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $result = Tour::search()->filter($request->validated())->paginate($request->input('per_page', 12))->toArray();
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
        return TourService::popularTours($request->input('count', 12));
    }

    /**
     * Поиск туров по названию (автокомплит)
     * @param Request $request
     * @return mixed
     */
    public function autocomplete(Request $request)
    {
        $q = $request->input('q', '');
        $limit = $request->input('limit', 10);
        return Tour::published()->autocomplete($q)->take($limit)->get()->map->shortInfo();
    }

    /**
     * Расписание тура
     * @param Request $request
     * @param Tour $tour
     * @return mixed
     */
    public function schedules(SearchEventsRequest $request, Tour $tour)
    {
        return $tour->scheduleItems()->inFuture()->filter($request->validated())->orderBy('start_date')->get();
    }


    /**
     * Поиск туров по названию (selectbox)
     * @param Request $request
     * @return mixed
     */
    public function selectBox(Request $request)
    {
        $q = $request->input('q', '');
        $paginator = Tour::autocomplete($q)->paginate($request->input('limit', 10));
        $items = [];
        foreach ($paginator->items() as $item) {
            $items[] = $item->asSelectBox();
        }

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
            $guidesQuery->whereHas('tours', fn ($q) => $q->where('id', $tour_id));
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