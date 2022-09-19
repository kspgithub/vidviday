<?php

namespace App\Mail;

use App\Models\OrderCertificate;

class OrderCertificateAdminMail extends BaseTemplateEmail
{
    public OrderCertificate $order;

    public static $subjectKey = 'emails.order-certificate-admin.subject';

    public static $viewKey = 'emails.order-certificate-admin';

    public function __construct(OrderCertificate $order = null)
    {
        $this->order = $order ?: OrderCertificate::random();
    }

    public function getReplaces()
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}
