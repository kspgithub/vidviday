<?php

namespace App\Lib\WayForPay;

use App\Models\OrderCertificate;

class PurchaseCertificate extends PurchaseAbstract
{
    public function __construct(OrderCertificate $order)
    {
        parent::__construct($order);

        $this->orderNumber = 'CERT' . $order->order_number;
        $this->orderReference = 'CERT' . $order->order_number . '-' . md5(microtime());
        $this->returnUrl = route('certificate.order.success', $order->id);


        $this->createNewTransaction();
    }
}
