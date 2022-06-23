<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourOrderRequest;
use App\Lib\Bitrix24\CRM\Deal\DealOrder;
use App\Mail\TourOrderAdminEmail;
use App\Mail\TourOrderEmail;
use App\Models\AccommodationType;
use App\Models\Order;
use App\Models\PaymentType;
use App\Services\MailNotificationService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('order.index', [
            'corporate' => !!$request->input('group_type', 0),
            'room_types' => AccommodationType::all()->translate(),
            'payment_types' => PaymentType::published()->toSelectBox(),
            'confirmation_types' => Order::confirmationSelectBox(),
        ]);
    }

    public function corporate()
    {
        return view('order.index', [
            'corporate' => true,
            'room_types' => AccommodationType::all()->translate(),
            'payment_types' => PaymentType::published()->toSelectBox(),
            'confirmation_types' => Order::confirmationSelectBox(),
        ]);
    }

    public function store(TourOrderRequest $request)
    {
        $params = $request->validated();

        $order = OrderService::createOrder($params);

        if ($order === false) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => 'Помилка при замовлені туру']);
            }
            return back()->withFlashError('Помилка при замовлені туру');
        } else {
            $order->syncContact();
            MailNotificationService::userTourOrder($order);
            MailNotificationService::adminTourOrder($order);

            if ((int)$order->payment_type === PaymentType::TYPE_ONLINE) {
                $redirect_route = 'order.purchase';
            } else {
                $redirect_route = 'order.success';
            }
            if ($request->ajax()) {
                return response()->json(['result' => 'success', 'redirect_url' => route($redirect_route, $order)]);
            }
            return redirect()->route($redirect_route, $order);
        }
    }


    public function purchase(Request $request, Order $order)
    {
        if ($order->payment_status !== Order::PAYMENT_PENDING) {
            return redirect()->route('order.success', $order);
        }

        $wizard = $order->purchaseWizard();

        return view('order.purchase', ['wizard' => $wizard, 'order' => $order, 'type' => 'tour']);
    }

    public function success(Request $request, Order $order)
    {

        return view('order.success', ['order' => $order]);
    }


    public function cancel(Request $request, $id)
    {
        $user = current_user();
        $order = $user->orders()->findOrFail($id);
        $order->cancel($request->only(['cause', 'comment']));
        try {
            DealOrder::cancelDeal($order);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'order' => $order]);
        }
        return redirect()->back()->withFlashSuccess(__('Request Sent'));
    }
}
