<?php

namespace App\Mail;

use App\Models\OrderTransport;

class OrderTransportAdminMail extends BaseTemplateEmail
{
    public OrderTransport $order;

    public static $subjectKey = 'emails.order-transport-admin.subject';

    public static $viewKey = 'emails.order-transport-admin';

    public function __construct(OrderTransport $order = null)
    {
        $this->order = $order ?: OrderTransport::random();
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
            'tour_name' => $this->order->tour->title ?? 'Корпоративний тур',
            'first_name' => $this->order->first_name,
            'last_name' => $this->order->last_name,
        ];
    }
}
