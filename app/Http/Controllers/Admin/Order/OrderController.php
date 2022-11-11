<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MailNotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //
        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        //
        $order = new Order();

        return view('admin.order.create', ['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $order = new Order();
        $order->fill($request->all());
        $order->syncContact();

        return redirect()->route('admin.order.index')->withFlashSuccess(__('Record Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return View|JsonResponse
     */
    public function show(Request $request, Order $order)
    {
        //
        if ($request->ajax()) {
            $order->makeVisible([
                'payment_fop',
                'payment_tov',
                'payment_office',
                'payment_data',
                'admin_comment',
                'agency_data',
                'utm_data',
            ]);

            return response()->json($order);
        }

        return view('admin.order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order  $order
     * @return View
     */
    public function edit(Order $order)
    {
        //
        return view('admin.order.edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Order  $order
     * @return Response|JsonResponse
     */
    public function update(Request $request, Order $order)
    {
        //
        $order->fill($request->all());
        $order->save();
        $order->syncContact();
        if ($request->ajax()) {
            $order->makeVisible([
                'payment_fop',
                'payment_tov',
                'payment_office',
                'admin_comment',
                'agency_data',
                'payment_data',
                'utm_data',
            ]);
            $order->loadMissing(['tour', 'schedule']);

            return response()->json(['result' => 'success', 'message' => __('Record Updated'), 'model' => $order]);
        }

        return redirect()->route('admin.order.index')->withFlashSuccess(__('Record Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order  $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();

        return redirect()->route('admin.order.index')->withFlashSuccess(__('Record Deleted'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        $notify = $request->input('notifySend', false);

        if ($notify) {
            $notifyEmail = $request->input('notifyEmail', $order->email);
            if (! empty($notifyEmail)) {
                $notifyMessage = $request->input('notifyMessage', '');
                MailNotificationService::userOrderStatus($order, $notifyEmail, $notifyMessage);
            }
        }

        $order->makeVisible([
            'payment_fop',
            'payment_tov',
            'payment_office',
            'admin_comment',
            'agency_data',
            'payment_data',
            'utm_data',
        ]);
        $order->loadMissing(['tour', 'schedule']);

        return response()->json(['result' => 'success', 'message' => __('Record Updated'), 'model' => $order]);
    }

    public function accomm(Request $request, Order $order)
    {
        $accommodation = $order->accommodation;
        $accommodation[$request->id] = $request->value;
        $order->accommodation = $accommodation;
        $order->save();

        return response()->json(['result' => 'success', 'message' => __('Record Updated'), 'model' => $order]);
    }
}
