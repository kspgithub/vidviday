<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateOrderRequest;
use App\Models\FaqItem;
use App\Models\OrderCertificate;
use App\Models\Packing;
use App\Models\Page;
use App\Models\PaymentType;
use App\Services\MailNotificationService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    //

    public function index()
    {
        $pageContent = Page::where('key', 'certificate')->first();
        $faqItems = FaqItem::published()->where('section', FaqItem::SECTION_CERTIFICATE)->orderBy('sort_order')->get();
        return view('certificate.index', [
            'pageContent' => $pageContent,
            'faqItems' => $faqItems,
        ]);
    }

    public function order()
    {
        $pageContent = Page::where('key', 'certificate-order')->first();
        $packings = Packing::all();
        $paymentTypes = PaymentType::published()->toSelectBox();

        return view('certificate.order', [
            'packings' => $packings,
            'paymentTypes' => $paymentTypes,
            'pageContent' => $pageContent,
        ]);
    }


    public function orderStore(CertificateOrderRequest $request)
    {
        $order = new OrderCertificate();
        $order->fill($request->validated());
        $order->price = $order->calcPrice();
        if (auth()->check()) {
            $order->user_id = current_user()->id;
        }
        $order->save();

        MailNotificationService::userCertificateEmail($order);
        MailNotificationService::adminCertificateEmail($order);

        return redirect()->route('certificate.order.success', $order);
    }

    public function orderSuccess(OrderCertificate $order)
    {
        $pageContent = Page::where('key', 'certificate-order')->first();
        return view('certificate.success', ['order' => $order, 'pageContent' => $pageContent]);
    }
}
