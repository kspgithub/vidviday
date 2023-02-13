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
use Illuminate\Support\Carbon;
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
            $paginator->getCollection()->transform(fn($item) => $item->asCrmSchedule());

            return response()->json($paginator);
        }

        $currencies = Currency::toSelectBox('iso', 'iso');
        $can_edit = $tour->userCanEditTour(current_user());
        $can_delete = $tour->userCanDeleteTour(current_user());
        return view('admin.tour-schedule.index', ['tour' => $tour, 'currencies' => $currencies, 'can_edit' => $can_edit, 'can_delete' => $can_delete]);
    }

    public function store(Request $request, Tour $tour)
    {
        Gate::allows('create');
        $records_count = $request->input('repeat_count', 1);
        $repeat = $request->input('repeat', '');
        $schedules = [];
        $corrector = 0;

        $start = $request->input('start_date', null);
        $start_time = $request->input('start_time', null);
        $end = $request->input('end_date', null);

        $totalDayNights = $tour->duration + $tour->nights;
        if ($tour->duration > $tour->nights) {
            $duration = floor($totalDayNights / 2);
        } else {
            $duration = ceil($totalDayNights / 2);
        }

        for ($i = 0; $i < $records_count; $i++) {
            $schedule = new TourSchedule();
            $schedule->tour_id = $tour->id;
            $schedule->places = $request->input('places', 48);
            $schedule->price = $request->input('price', $tour->price);
            $schedule->commission = $request->input('commission', $tour->commission);
            $schedule->accomm_price = $request->input('accomm_price', $tour->accomm_price);
            $schedule->currency = $request->input('currency', $tour->currency);
            $schedule->comment = $request->input('comment', '');
            $schedule->auto_booking = $request->input('auto_booking', false);
            $schedule->auto_limit = $request->input('auto_limit', 10);

            $startDate = Carbon::createFromFormat('d.m.Y', $start);
            $endDate = Carbon::make($startDate)->addDays($duration);

            switch ($repeat) {
                case 'daily':
                    $startDate->addDays($i)->format('d.m.Y');
//                    $end_date = $endDate->addDays($i)->format('d.m.Y');
                    break;
                case 'weekly':
                    $startDate->addWeeks($i)->format('d.m.Y');
//                    $end_date = $endDate->addWeeks($i)->format('d.m.Y');
                    break;
                case 'fortnightly':
                    $startDate->addWeeks($i * 2)->format('d.m.Y');
//                    $end_date = $endDate->addWeeks($i * 2)->format('d.m.Y');
                    break;
                case 'custom':
                    $interval = $request->input('repeat_custom_interval');
                    $day_of_week = $request->input('repeat_day_of_week');
                    if ($interval === 'all') {
                        $startDate->addWeeks($i)->addDays(-1)->next($day_of_week)->format('d.m.Y');
//                        $end_date = $endDate->addWeeks($i)->addDays(-1)->next($day_of_week)->format('d.m.Y');
                    } else {
                        $interval = (int)$interval;
                        $startDate->addMonths($i + $corrector)->startOfMonth()->addWeeks($interval - 1)->addDays(-1)->next($day_of_week);
//                        $endDateModified = $endDate->addMonths($i + $corrector)->startOfMonth()->addWeeks($interval - 1)->addDays(-1)->next($day_of_week);
                        while ($startDate->lessThan($start)) {
                            $startDate->addMonth()->startOfMonth()->addWeeks($interval - 1)->addDays(-1)->next($day_of_week);
//                            $endDateModified = $endDateModified->addMonth()->startOfMonth()->addWeeks($interval - 1)->addDays(-1)->next($day_of_week);
                            $corrector++;
                        }
//                        $start_date = $startDateModified->format('d.m.Y');
//                        $end_date = $endDateModified->format('d.m.Y');
                    }
                    break;
                default:
//                    $start_date = $startDate->format('d.m.Y');
//                    $end_date = $endDate->format('d.m.Y');
                    break;
            }

            $endDate = Carbon::make($startDate)->addDays($duration);

            $start_date = $startDate->format('d.m.Y');
            $end_date = $endDate->format('d.m.Y');

            $schedule->start_date = $start_date;
            $schedule->start_time = $start_time ?: null;
            $schedule->end_date = $end_date;
            $schedule->save();

            $schedules[] = $schedule->asCrmSchedule();
        }


        return response()->json([
            'result' => 'success',
            'message' => __('Record Created'),
            'schedule' => $schedules,
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
