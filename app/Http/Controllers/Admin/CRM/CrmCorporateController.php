<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Staff;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CrmCorporateController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $orderQ = Order::query()->where('group_type', Order::GROUP_CORPORATE)
                ->filter($request)->with(['tour', 'tour.manager', 'schedule']);

            if (current_user()->isTourManager()) {
                $orderQ->whereHas('tour', fn ($sq) => $sq->whereHas('staff', fn ($ssq) => $ssq->where('id', current_user()->staffs->first()->id)));
            }

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
        return view('admin.crm.corporate.index', [
            'managers' => $managers,
            'statuses' => $statuses,
            'tours' => $tours,
        ]);
    }

    public function create(Request $request)
    {
        //

        $order = new Order();
        $order->group_type = Order::GROUP_CORPORATE;
        $order->program_type = Order::PROGRAM_EXISTS;
        $order->price_include = [];

        $statuses = arrayToSelectBox(Order::statuses());
        $currencies = Currency::toSelectBox('iso', 'iso');
        $paymentTypes = PaymentType::toSelectBox();
        $paymentStatuses = arrayToSelectBox(Order::$paymentStatuses);
        $roomTypes = AccommodationType::toSelectBox();
        $includes = arrayToSelectBox(Order::includes());
        return view('admin.crm.corporate.create', [
            'statuses' => $statuses,
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'includes' => $includes,
            'order' => $order,
        ]);
    }

    public function store(Request $request)
    {
        //
        $order = new Order();
        $order->fill($request->all());
        $order->save();
        return redirect()->route('admin.crm.corporate.edit', $order)->withFlashSuccess(__('Record Created'));
    }

    public function show(Order $order)
    {
        //
        $order->loadMissing(['tour', 'tour.manager', 'schedule']);
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
        $includes = arrayToSelectBox(Order::includes());
        $tour = $order->tour;
        $discounts = $tour && $tour->discounts ? $tour->discounts->map->asAlpineData() : [];
        return view('admin.crm.corporate.show', [
            'tour' => $tour ? $tour->shortInfo() : null,
            'order' => $order,
            'discounts' => $discounts,
            'statuses' => $statuses,
            'includes' => $includes,
        ]);
    }

    public function edit(Order $order)
    {
        //
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
        $includes = arrayToSelectBox(Order::includes());
        return view('admin.crm.corporate.edit', [
            'statuses' => $statuses,
            'currencies' => $currencies,
            'paymentTypes' => $paymentTypes,
            'paymentStatuses' => $paymentStatuses,
            'roomTypes' => $roomTypes,
            'includes' => $includes,
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        //
        $order->fill($request->all());
        $order->save();

        return redirect()->route('admin.crm.corporate.edit', $order)->withFlashSuccess(__('Record Updated'));
    }

    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->route('admin.crm.corporate.index')->withFlashSuccess(__('Record Deleted'));
    }

}
