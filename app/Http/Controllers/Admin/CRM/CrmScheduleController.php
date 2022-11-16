<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Exports\OrdersExport;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CrmScheduleController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = TourSchedule::query()->with(['tour', 'tour.manager', 'orders']);

//            if (current_user()->isTourManager()) {
//                $query->whereHas('tour', fn ($sq) => $sq->whereHas('manager', fn ($ssq) => $ssq->where('user_id', current_user()->id)));
//            }

            $tab = $request->input('tab', 'recruited');
            $query->tab($tab);

            $manager_id = $request->input('manager_id', 0);
            if ($manager_id > 0) {
                $query->whereHas('tour', fn ($sq) => $sq->where('manager_id', $manager_id));
            }

            $booked = $request->input('booked', 0);
            if ($booked > 0) {
                $query->whereHas('orders');
            }
            $dates = $request->input('dates', '');
            if (!empty($dates)) {
                $dateParts = array_filter(explode('-', $dates));
                if (!empty($dateParts[0])) {
                    $query->whereDate('start_date', '>=', Carbon::createFromFormat('d.m.Y', $dateParts[0]));
                }
                if (!empty($dateParts[1])) {
                    $query->whereDate('start_date', '<=', Carbon::createFromFormat('d.m.Y', $dateParts[1]));
                }
            }
            $order = explode(':', $request->input('order', 'start_date:asc'));
            $query->orderBy($order[0] ?? 'start_date', $order[1] ?? 'asc');

            $paginator = $query->paginate(20);
            $paginator->getCollection()->transform(function ($val) {
                $val->tour->makeHidden([
                    'main_image',
                    'mobile_image',
                ]);
                $val->makeVisible([
                    'bus',
                    'guide',
                    'duty_transport',
                    'duty_call',
                    'admin_comment',
                    'duty_comment',
                    'auto_booking',
                    'auto_limit',
                ]);
                $val->append(['manager']);

                return $val;
            });

            return response()->json($paginator);
        }
        $managers = Staff::onlyTourManagers()->get()->map->asSelectBox();

        return view('admin.crm.schedule.index', [
            'managers' => $managers,
        ]);
    }

    public function show(Request $request, TourSchedule $schedule)
    {
        $schedule->load(['tour', 'tour.manager']);
        $schedule->append(['manager']);

        $tab = $request->input('tab', 'common');

        $count_items = [
            'reserve' => $schedule->totalPlacesByStatus([Order::STATUS_RESERVE]),
            'interested' => $schedule->totalPlacesByStatus([Order::STATUS_INTERESTED, Order::STATUS_NOT_SENT]),
            'cancel' => $schedule->totalPlacesByStatus([Order::STATUS_CANCELED, Order::STATUS_PENDING_CANCEL]),
            'common' => $schedule->totalPlacesByStatus([Order::STATUS_NEW, Order::STATUS_BOOKED, Order::STATUS_DEPOSIT, Order::STATUS_PAYED, Order::STATUS_COMPLETED]),
        ];

        if ($request->ajax() || $request->input('export', 0) == 1) {
            $ordersQ = $schedule->orders();

            if($ids = json_decode($request->input('orders', '[]'), true)) {
                $ordersQ->whereIn('id', $ids);
            }

            switch ($tab) {
                case 'reserve':
                    $ordersQ->whereIn('status', [Order::STATUS_RESERVE]);

                    break;
                case 'interested':
                    $ordersQ->whereIn('status', [Order::STATUS_INTERESTED, Order::STATUS_NOT_SENT]);

                    break;
                case 'cancel':
                    $ordersQ->whereIn('status', [Order::STATUS_CANCELED, Order::STATUS_PENDING_CANCEL]);

                    break;
                default:
                    $ordersQ->whereIn('status', [Order::STATUS_NEW, Order::STATUS_BOOKED, Order::STATUS_DEPOSIT, Order::STATUS_PAYED, Order::STATUS_COMPLETED]);
            }
            $order = explode(':', $request->input('order', 'id:asc'));
            $ordersQ->orderBy($order[0] ?? 'id', $order[1] ?? 'asc');
            $orders = $ordersQ->get()->makeVisible([
                'payment_fop',
                'payment_tov',
                'payment_office',
                'admin_comment',
                'duty_comment',
                'agency_data',
            ]);

            if ($request->input('export', 0) == 1) {
                return Excel::download(new OrdersExport($orders), 'export.xlsx');
            }

            return response()->json([
                'orders' => $orders,
                'countOrders' => $count_items
            ]);
        }

        $schedule->makeVisible([
            'bus',
            'guide',
            'duty_transport',
            'duty_call',
            'admin_comment',
            'duty_comment',
            'auto_booking',
            'auto_limit',
        ]);

        $roomTypes = AccommodationType::get(['short_title as text', 'slug as value'])
            ->map(fn ($it) => ['text' => $it->text, 'value' => str_replace('-', '_', $it->value)])->toArray();

        return view('admin.crm.schedule.show', [
            'schedule' => $schedule,
            'tour' => $schedule->tour,
            'statuses' => arrayToSelectBox(Order::statuses()),
            'roomTypes' => $roomTypes,
            'countOrders' => $count_items
        ]);
    }

    public function update(Request $request, TourSchedule $schedule)
    {
        $schedule->fill($request->all());
        $schedule->save();

        return response()->json([
            'result' => 'success',
            'message' => __('Record Updated'),
            'schedule' => $schedule->asCrmSchedule()
        ]);
    }

    public function uploadInfoSheet(Request $request, TourSchedule $schedule)
    {
        if ($infoSheet = $request->file('info_sheet')) {
            $fileName = Str::replace(' ', '%20', $infoSheet->getClientOriginalName());
            $infoSheetFile = Storage::url($schedule->storeFileAs($infoSheet, "uploads/files", $fileName));
        } else {
            if($schedule->info_sheet) {
                $path = Str::replace('/storage', '', $schedule->info_sheet);
                if(Storage::disk('public')->get($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $infoSheetFile = null;
        }

        $schedule->update(['info_sheet' => $infoSheetFile]);

        return response()->json([
            'result' => 'success',
            'message' => __('Record Updated'),
            'schedule' => $schedule->asCrmSchedule()
        ]);
    }

    public function order(TourSchedule $schedule, Order $order)
    {
        $schedule->makeVisible([
            'bus',
            'guide',
            'duty_transport',
            'duty_call',
            'admin_comment',
            'duty_comment',
            'auto_booking',
            'auto_limit',
        ]);

        $order->loadMissing(['tour', 'tour.manager', 'schedule']);
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
        $statuses = arrayToSelectBox(Order::statuses());
        $tour = $schedule->tour;
        $schedules = $tour->scheduleItems()->get()->map->asCrmSchedule();
        $discounts = $tour->discounts()->get()->map->asAlpineData();

        $currencies = Currency::toSelectBox('iso', 'iso');
        $paymentTypes = PaymentType::toSelectBox();
        $paymentStatuses = arrayToSelectBox(Order::$paymentStatuses);
        $roomTypes = AccommodationType::toSelectBox();

        return view('admin.crm.schedule.order', [
            'tour' => $tour->shortInfo(),
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'discounts' => $discounts,
            'schedule' => $schedule,
            'order' => $order,
            'statuses' => $statuses,
            'schedules' => $schedules,
            'redirect' => true,
        ]);
    }
}
