<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\OrderTransport;
use App\Models\Page;
use App\Models\PopupAd;
use App\Models\Transport;
use App\Services\MailNotificationService;
use Illuminate\Http\Request;

class TransportController extends Controller
{

    public function index()
    {
        //
        $pageContent = Page::where('key', 'transport')->first();

        $transports = Transport::published()->get();

        $popupAds = PopupAd::query()->whereJsonContains('pages', $pageContent->key)->get();

        return view('transport.index', [
            'pageContent' => $pageContent,
            'transports' => $transports,
            'popupAds' => $popupAds,
        ]);
    }


    public function order(Request $request)
    {
        $order = new OrderTransport();
        $order->fill($request->all());
        if (current_user()) {
            $order->user_id = current_user()->id;
        }
        $order->status = OrderTransport::STATUS_NEW;
        $order->save();
        MailNotificationService::userTransportEmail($order);
        MailNotificationService::adminTransportEmail($order);
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Thanks for your order!')]);
        }
        return redirect(pageUrlByKey('transport'))->withFlashSuccess(__('Thanks for your order!'));
    }
}
