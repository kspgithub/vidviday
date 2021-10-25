<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourOrderRequest;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Models\AccommodationType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('order.index', [
            'corporate' => false,
            'room_types' => AccommodationType::all(),
            'payment_types' => PaymentType::published()->toSelectBox(),
            'confirmation_types' => Order::confirmationSelectBox(),
        ]);
    }

    public function corporate()
    {
        return view('order.index', [
            'corporate' => true,
            'room_types' => AccommodationType::all(),
            'payment_types' => PaymentType::published()->toSelectBox(),
            'confirmation_types' => Order::confirmationSelectBox(),
        ]);
    }

    public function store(TourOrderRequest $request)
    {
        $params = $request->validated();
        $params['user_id'] = current_user() ? current_user()->id : null;
        $params['is_tour_agent'] = current_user() && current_user()->isTourAgent();
        $order = OrderService::createOrder($params);
        if ($order !== false && config('services.bitrix24.integration')) {
            DealOrder::createOrder($order);
        }
        if ($order === false) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => 'Помилка при замовлені туру']);
            }
            return back()->withFlashError('Помилка при замовлені туру');
        } else {
            if ($request->ajax()) {
                return response()->json(['result' => 'success', 'redirect_url' => route('order.success', $order)]);
            }
            return redirect()->route('order.success', $order);
        }
    }

    public function success(Request $request, Order $order)
    {

        return view('order.success', ['order' => $order]);
    }
}
