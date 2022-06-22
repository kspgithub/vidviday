<?php

namespace App\Lib\WayForPay;

use App\Models\Order;

class PurchaseTour extends PurchaseAbstract
{


    public function __construct(Order $order)
    {
        parent::__construct($order);
        $this->orderNumber = 'TOUR' . $order->order_number;
        $this->orderReference = 'TOUR' . $order->order_number . '-' . md5(microtime());
        $this->returnUrl = route('order.success', $order->id);

        $this->createNewTransaction();
    }

}
