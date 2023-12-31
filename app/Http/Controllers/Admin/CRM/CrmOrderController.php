<?php

namespace App\Http\Controllers\Admin\CRM;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\QuestionType;
use App\Models\Staff;
use App\Models\Tour;
use App\Models\TourSchedule;
use App\Models\UserQuestion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Models\Discount;

class CrmOrderController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $orderQ = Order::query()->where('group_type', Order::GROUP_TEAM)
                ->with(['tour', 'tour.manager', 'schedule']);

            if (current_user()->isTourManager()) {
                $orderQ->whereHas('tour', fn ($sq) => $sq->whereHas('staff', fn ($ssq) => $ssq->where('id', current_user()->staffs->first()->id)));
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
            $tours = Tour::query()->whereHas('staff', fn ($ssq) => $ssq->where('id', current_user()->staffs->first()->id))->toSelectBox();
        } else {
            $tours = Tour::toSelectBox();
        }

        $abolitionTypes = QuestionType::query()->where('type', UserQuestion::TYPE_CANCEL)
            ->published()
            ->pluck('title', 'id');

        return view('admin.crm.order.index', [
            'managers' => $managers,
            'statuses' => $statuses,
            'abolitionTypes' => $abolitionTypes,
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
                /* $discounts = $schedule->tour->discounts->map->asAlpineData()->all(); */
                $tour = $schedule->tour->shortInfo();
            }
        }

        $ds = Discount::all();
        $discounts = $ds->map->asAlpineData();

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

        $params = $request->all();

        foreach($params['participants']['items'] as $key => $participant){
            if (empty($participant['first_name'])){
                unset($params['participants']['items'][$key]);
            }
        }

        foreach($params['participant_contacts'] as $key => $participant){
            if (empty($participant['phone'])){
                unset($params['participant_contacts'][$key]);
            }
        }
        
        $order->fill($params);

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
        $schedule = $order->schedule ? (object) $order->schedule->asCrmSchedule() : null;
        $audits = [];
        $discounts = $tour && $tour->discounts ? $tour->discounts->map->asAlpineData() : [];

        $roomTypes = AccommodationType::toSelectBox();

        if (empty($order->utm_data)) {
            $order->utm_data = ['customer_source' => '', 'customer_device' => ''];
        }

        $abolitionTypes = QuestionType::query()->where('type', UserQuestion::TYPE_CANCEL)
            ->published()
            ->pluck('title', 'id');

        return view('admin.crm.order.show', [
            'tour' => $tour ? $tour->shortInfo() : null,
            'discounts' => $discounts,
            'schedule' => $schedule,
            'order' => $order,
            'roomTypes' => $roomTypes,
            'statuses' => $statuses,
            'schedules' => $schedules,
            'audits' => $audits,
            'abolitionTypes' => $abolitionTypes,
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
        if (empty($order->utm_data)) {
            $order->utm_data = ['customer_source' => '', 'customer_device' => ''];
        }

        $abolitionTypes = QuestionType::query()->where('type', UserQuestion::TYPE_CANCEL)
        ->published()
        ->pluck('title', 'id');
        
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
            'abolitionTypes' => $abolitionTypes,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        //
        $params = $request->all();

        foreach($params['participants']['items'] as $key => $participant){
            if (empty($participant['first_name'])){
                unset($params['participants']['items'][$key]);
            }
        }

        foreach($params['participant_contacts'] as $key => $participant){
            if (empty($participant['phone'])){
                unset($params['participant_contacts'][$key]);
            }
        }

        $order->fill($params);
        if (!$request->isAdmin() && $order->status !== Order::STATUS_RESERVE && $order->isOverloaded()) {
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
        $query = Order::whereIn('status', $status);
        $group_type = (int) $request->input('group_type', null);

        if (!is_null($group_type)) {
            $query->where('group_type', $group_type);
        }
        if (current_user()->isTourManager() && $group_type === 0) {
            $query->whereHas('tour', fn ($sq) => $sq->whereHas('staff', fn ($ssq) => $ssq->where('id', current_user()->staffs->first()->id)));
        }

        if (in_array(Order::STATUS_CANCELED, $status)) {
            $abolitionTypes = QuestionType::query()->where('type', UserQuestion::TYPE_CANCEL)
                ->published()
                ->pluck('id');

            $query->whereNotNull('abolition');

            $query->where(function (Builder $q) use ($abolitionTypes) {
                foreach ($abolitionTypes as $type) {
                    $q->orWhereJsonContains('abolition->cause', $type);
                }
            });
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

    public function cancel(Order $order)
    {
        $order->status = Order::STATUS_CANCELED;
        $order->save();

        return redirect()->back()->withFlashSuccess(__('Record Updated'));
    }
}
