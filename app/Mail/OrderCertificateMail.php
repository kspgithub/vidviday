<?php

namespace App\Mail;

use App\Models\OrderCertificate;

class OrderCertificateMail extends BaseTemplateEmail
{
    public OrderCertificate $order;

    public static $subjectKey = 'emails.order-certificate.subject';

    public static $viewKey = 'emails.order-certificate';

    public function __construct(OrderCertificate $order = null)
    {
        $this->order = $order ?: OrderCertificate::random();
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
            'last_name' => $this->order->last_name,
        ];
    }
}
