<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Staff;
use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class CrmOrderController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $orderQ = Order::query()->where('group_type', Order::GROUP_TEAM)
                ->with(['tour', 'tour.manager', 'schedule']);

            if (current_user()->isTourManager()) {
                $orderQ->whereHas('tour', fn ($sq) => $sq->whereHas('manager', fn ($ssq) => $ssq->where('user_id', current_user()->id)));
            }

            $orderQ->filter($request);

            $paginator = $orderQ->paginate($request->input('per_page', 20));
            $paginator->getCollection()->transform(function ($val) {
                $val->makeVisible([
                    'duty_comment',
                    'admin_comment',
                    'agency_data',
                ]);

                return $val;
            });

            return response()->json($paginator);
        }

        $managers = Staff::onlyTourManagers()->get()->map->asSelectBox();
        $statuses = arrayToSelectBox(Order::statuses());
        if (current_user()->isTourManager()) {
            $tours = Tour::query()->whereHas('manager', fn ($ssq) => $ssq->where('user_id', current_user()->id))->toSelectBox();
        } else {
            $tours = Tour::toSelectBox();
        }

        return view('admin.crm.order.index', [
            'managers' => $managers,
            'statuses' => $statuses,
            'tours' => $tours,
        ]);
    }

    public function create(Request $request)
    {
        //

        $group_type = $request->input('group_type', 0);
        $order = new Order();
        $order->group_type = $group_type;
        $discounts = [];
        $tour = null;
        $schedule = null;
        $schedule_id = $request->input('schedule_id', 0);
        if ($schedule_id > 0) {
            $schedule = TourSchedule::find($schedule_id);
            if ($schedule) {
                $order->tour_id = $schedule->tour_id;
                $order->schedule_id = $schedule->id;
                $discounts = $schedule->tour->discounts->map->asAlpineData()->all();
                $tour = $schedule->tour->shortInfo();
            }
        }

        if (current_user()->isDutyManager()) {
            $statuses = arrayToSelectBox(Order::dutyStatuses());
        } else {
            $statuses = arrayToSelectBox(Order::statuses());
        }

        $currencies = Currency::toSelectBox('iso', 'iso');
        $paymentTypes = PaymentType::toSelectBox();
        $paymentStatuses = arrayToSelectBox(Order::$paymentStatuses);
        $roomTypes = AccommodationType::toSelectBox();

        $order->makeHidden(['tour', 'schedule', 'tour_manager']);

        return view('admin.crm.order.create', [
            'statuses' => $statuses,
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'order' => $order,
            'tour' => $tour,
            'schedule' => $schedule ? $schedule->asCrmSchedule() : null,
            'availableDiscounts' => $discounts,
        ]);
    }

    public function store(Request $request)
    {
        //
        $order = new Order();
        $order->fill($request->all());

        if ($order->status !== Order::STATUS_RESERVE && $order->isOverloaded()) {
            $order->status = Order::STATUS_RESERVE;
        }
        $order->save();
        $order->syncContact();

        return redirect()->route('admin.crm.schedule.show', $order->schedule)->withFlashSuccess(__('Record Created'));
    }

    public function show(Order $order)
    {
        //
        $order->loadMissing(['tour', 'tour.discounts', 'tour.manager', 'schedule']);
        $order->makeVisible([
            'payment_fop',
            'payment_tov',
            'payment_office',
            'admin_comment',
            'duty_comment',
            'agency_data',
            'payment_data',
            'utm_data',
        ]);

        if (current_user()->isDutyManager()) {
            $statuses = arrayToSelectBox(Order::dutyStatuses());
        } else {
            $statuses = arrayToSelectBox(Order::statuses());
        }

        $tour = $order->tour;
        $schedules = $tour ? $tour->scheduleItems()->get()->map->shortInfo() : [];
        $schedule = $order->schedule ? (object)$order->schedule->asCrmSchedule() : null;
        $audits = [];
        $discounts = $tour && $tour->discounts ? $tour->discounts->map->asAlpineData() : [];

        $roomTypes = AccommodationType::toSelectBox();

        return view('admin.crm.order.show', [
            'tour' => $tour ? $tour->shortInfo() : null,
            'discounts' => $discounts,
            'schedule' => $schedule,
            'order' => $order,
            'roomTypes' => $roomTypes,
            'statuses' => $statuses,
            'schedules' => $schedules,
            'audits' => $audits,
        ]);
    }

    public function edit(Order $order)
    {
        //
        $order->loadMissing(['tour', 'tour.discounts', 'schedule']);

        $order->makeVisible([
            'payment_fop',
            'payment_tov',
            'payment_office',
            'duty_comment',
            'admin_comment',
            'agency_data',
            'payment_data',
            'utm_data',
        ]);

        if (current_user()->isDutyManager()) {
            $statuses = arrayToSelectBox(Order::dutyStatuses());
        } else {
            $statuses = arrayToSelectBox(Order::statuses());
        }

        $currencies = Currency::toSelectBox('iso', 'iso');
        $paymentTypes = PaymentType::toSelectBox();
        $paymentStatuses = arrayToSelectBox(Order::$paymentStatuses);
        $roomTypes = AccommodationType::toSelectBox();
        $discounts = $order->tour->discounts->map->asAlpineData()->all();
        $schedule = null;
        $tour = null;
        if (!empty($order->schedule)) {
            $schedule = $order->schedule->asCrmSchedule();
        }
        if (!empty($order->tour)) {
            $tour = $order->tour->shortInfo();
        }
        $order->makeHidden(['tour', 'schedule', 'tour_manager']);

        return view('admin.crm.order.edit', [
            'statuses' => $statuses,
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'order' => $order,
            'tour' => $tour,
            'schedule' => $schedule,
            'availableDiscounts' => $discounts,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        //
        $params = $request->all();
        $order->fill($params);
        if ($order->status !== Order::STATUS_RESERVE && $order->isOverloaded()) {
            $order->status = Order::STATUS_RESERVE;
        }
        $order->save();
        $order->syncContact();
        return redirect()->route('admin.crm.order.edit', $order)->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Order $order)
    {
        //
        $order->delete();

        return redirect()->route('admin.crm.order.index')->withFlashSuccess(__('Record Deleted'));
    }

    public function count(Request $request)
    {
        //
        $status = array_filter(explode('|', $request->input('status', 'new')));
        $group_type = (int)$request->input('group_type', 0);
        $query = Order::where('group_type', $group_type)->whereIn('status', $status);
        if (current_user()->isTourManager() && $group_type === 0) {
            $query->whereHas('tour', fn ($sq) => $sq->whereHas('manager', fn ($ssq) => $ssq->where('user_id', current_user()->id)));
        }

        return $query->count();
    }

    public function audits(Order $order)
    {
        //
        $query = $order->audits()->with('user')->latest();

        $paginator = $query->paginate(20);
        $paginator->getCollection()->transform(function (Audit $item) {
            $data = $item->toArray();
            $data['user'] = $item->user ? $item->user->basicInfo() : ['name' => 'Система'];

            if (isset($item->new_values['tour_id']) && isset($item->old_values['tour_id'])) {
                $tour = Tour::query()->find($item->old_values['tour_id']);
                $newTour = Tour::query()->find($item->new_values['tour_id']);
                $data['old_values']['tour_id'] = '<a href="' . route('admin.tour.show', $tour->id) . '">' . $tour->title . '</a>';
                $data['new_values']['tour_id'] = '<a href="' . route('admin.tour.show', $newTour->id) . '">' . $newTour->title . '</a>';
            }
            if (isset($item->new_values['schedule_id']) && isset($item->old_values['schedule_id'])) {
                $schedule = TourSchedule::query()->find($item->old_values['schedule_id']);
                $newSchedule = TourSchedule::query()->find($item->new_values['schedule_id']);
                $data['old_values']['schedule_id'] = '<a href="' . route('admin.crm.schedule.show', $schedule->id) . '">' . $schedule->title . '</a>';
                $data['new_values']['schedule_id'] = '<a href="' . route('admin.crm.schedule.show', $newSchedule->id) . '">' . $newSchedule->title . '</a>';
            }

            return $data;
        });

        return $paginator;
    }
}
