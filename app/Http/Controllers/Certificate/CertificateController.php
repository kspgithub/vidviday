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
        $localeLinks = $pageContent->getLocaleLinks();
        $faqItems = FaqItem::published()->where('section', FaqItem::SECTION_CERTIFICATE)->orderBy('sort_order')->get();
        return view('certificate.index', [
            'pageContent' => $pageContent,
            'localeLinks' => $localeLinks,
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
        if ((int)$order->payment_type === PaymentType::TYPE_ONLINE) {
            $redirectRoute = 'certificate.order.purchase';
        } else {
            $redirectRoute = 'certificate.order.success';
        }
        return redirect()->route($redirectRoute, $order);
    }

    public function purchase(Request $request, OrderCertificate $order)
    {
        if ($order->payment_status !== OrderCertificate::PAYMENT_PENDING) {
            return redirect()->route('certificate.order.success', $order);
        }

        $wizard = $order->purchaseWizard();

        return view('certificate.purchase', ['wizard' => $wizard, 'order' => $order, 'type' => 'certificate']);
    }

    public function orderSuccess(OrderCertificate $order)
    {
        $pageContent = Page::where('key', 'certificate-order')->first();
        return view('certificate.success', ['order' => $order, 'pageContent' => $pageContent]);
    }
}
