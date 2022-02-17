<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Services\TourScheduleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TourScheduleController extends Controller
{
    protected $service;

    public function __construct(TourScheduleService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View|JsonResponse
     */
    public function index(Request $request, Tour $tour)
    {
        //
        if ($request->ajax()) {
            $query = $tour->scheduleItems()->with(['orders']);


            $sort = $request->input('order', 'start_date:desc');
            $sortParts = explode(':', $sort);
            $query->orderBy($sortParts[0] ?? 'start_date', $sortParts[1] ?? 'desc');

            $paginator = $query->paginate($request->input('per_page', 20));
            $paginator->getCollection()->transform(fn ($item) => $item->asCrmSchedule());
            return response()->json($paginator);
        }

        $currencies = Currency::toSelectBox('iso', 'iso');
        return view('admin.tour-schedule.index', ['tour' => $tour, 'currencies' => $currencies]);
    }

    public function store(Request $request, Tour $tour)
    {
        Gate::allows('create');
        $schedule = new TourSchedule();
        $schedule->fill($request->all());
        $schedule->tour_id = $tour->id;
        $schedule->save();
        return response()->json([
            'result' => 'success',
            'message' => __('Record Created'),
            'schedule' => $schedule->asCrmSchedule(),
        ]);
    }


    public function update(Request $request, Tour $tour, TourSchedule $schedule)
    {
        Gate::allows('update', $schedule);
        $schedule->fill($request->all());
        $schedule->save();
        return response()->json([
            'result' => 'success',
            'message' => __('Record Updated'),
            'schedule' => $schedule->asCrmSchedule(),
        ]);
    }


    public function destroy(Request $request, Tour $tour, TourSchedule $schedule)
    {
        Gate::allows('delete', $schedule);
        $schedule->delete();
        return response()->json([
            'result' => 'success',
            'message' => __('Record Deleted'),
            'schedule' => $schedule->asCrmSchedule(),
        ]);
    }
}
