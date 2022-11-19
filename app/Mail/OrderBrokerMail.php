<?php

namespace App\Mail;

use App\Models\OrderBroker;

class OrderBrokerMail extends BaseTemplateEmail
{
    public OrderBroker $order;

    public static $subjectKey = 'emails.order-broker.subject';

    public static $viewKey = 'emails.order-broker';

    public function __construct(OrderBroker $order = null)
    {
        $this->order = $order ?: OrderBroker::random() ?: new OrderBroker;
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}
