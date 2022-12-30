<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\OrderBroker;
use App\Models\Page;
use App\Models\PopupAd;
use App\Services\MailNotificationService;
use Illuminate\Http\Request;

class BrokerController extends Controller
{

    public function index()
    {
        //
        $pageContent = Page::published()->where('key', 'broker')->firstOrFail();

        $popupAds = PopupAd::query()->forModel($pageContent)->get();

        return view('broker.index', [
            'pageContent' => $pageContent,
            'popupAds' => $popupAds,
        ]);
    }


    public function order(Request $request)
    {
        $order = new OrderBroker();
        $order->fill($request->all());
        if (current_user()) {
            $order->user_id = current_user()->id;
        }
        $order->status = OrderBroker::STATUS_NEW;
        $order->save();
        MailNotificationService::userBrokerEmail($order);
        MailNotificationService::adminBrokerEmail($order);
        if ($request->ajax()) {
            return response()->json(['result' => 'success', 'message' => __('Thanks for your order!')]);
        }
        return redirect(pageUrlByKey('transport'))->withFlashSuccess(__('Thanks for your order!'));
    }
}
