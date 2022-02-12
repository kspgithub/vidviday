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
use Illuminate\Support\Carbon;

class CrmOrderController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $orderQ = Order::query()->where('group_type', Order::GROUP_TEAM)
                ->filter($request)
                ->with(['tour', 'tour.manager', 'schedule']);

            $paginator = $orderQ->paginate(20);
            $paginator->getCollection()->transform(function ($val) {
                $val->makeVisible([
                    'admin_comment',
                    'agency_data',
                ]);
                return $val;
            });

            return response()->json($paginator);
        }

        $managers = Staff::onlyTourManagers()->get()->map->asSelectBox();
        $statuses = arrayToSelectBox(Order::statuses());
        $tours = Tour::toSelectBox();
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

        $schedule_id = $request->input('schedule_id', 0);
        if ($schedule_id > 0) {
            $schedule = TourSchedule::find($schedule_id);
            if ($schedule) {
                $order->tour_id = $schedule->tour_id;
                $order->schedule_id = $schedule->id;
            }

        }

        $statuses = arrayToSelectBox(Order::statuses());
        $currencies = Currency::toSelectBox('iso', 'iso');
        $paymentTypes = PaymentType::toSelectBox();
        $paymentStatuses = arrayToSelectBox(Order::$paymentStatuses);
        $roomTypes = AccommodationType::toSelectBox();
        return view('admin.crm.order.create', [
            'statuses' => $statuses,
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'order' => $order,
        ]);
    }

    public function store(Request $request)
    {
        //
        $order = new Order();
        $order->fill($request->all());
        $order->save();
        return redirect()->route('admin.crm.order.edit', $order)->withFlashSuccess(__('Record Created'));
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
            'agency_data',
            'payment_data',
            'utm_data',
        ]);
        $statuses = arrayToSelectBox(Order::statuses());
        $tour = $order->tour;
        $schedules = $tour->scheduleItems()->get()->map->shortInfo();
        $schedule = $order->schedule;
        return view('admin.crm.order.show', [
            'tour' => $tour->shortInfo(),
            'discounts' => $tour->discounts ?? [],
            'schedule' => $schedule,
            'order' => $order,
            'statuses' => $statuses,
            'schedules' => $schedules,
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
            'admin_comment',
            'agency_data',
            'payment_data',
            'utm_data',
        ]);

        $statuses = arrayToSelectBox(Order::statuses());
        $currencies = Currency::toSelectBox('iso', 'iso');
        $paymentTypes = PaymentType::toSelectBox();
        $paymentStatuses = arrayToSelectBox(Order::$paymentStatuses);
        $roomTypes = AccommodationType::toSelectBox();

        return view('admin.crm.order.edit', [
            'statuses' => $statuses,
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        //
        $order->fill($request->all());
        $order->save();

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
        $status = $request->input('status', 'new');
        $group_type = $request->input('group_type', 0);

        return Order::where('group_type', $group_type)->where('status', $status)->count();
    }
}
