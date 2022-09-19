<?php

namespace App\Mail;

use App\Models\OrderTransport;

class OrderTransportMail extends BaseTemplateEmail
{
    public OrderTransport $order;

    public static $subjectKey = 'emails.order-transport.subject';

    public static $viewKey = 'emails.order-transport';

    public function __construct(OrderTransport $order = null)
    {
        $this->order = $order ?: OrderTransport::random();
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}
