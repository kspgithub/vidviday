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
}
