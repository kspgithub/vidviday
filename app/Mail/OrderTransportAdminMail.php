<?php

namespace App\Mail;

use App\Models\OrderTransport;

class OrderTransportAdminMail extends BaseTemplateEmail
{
    public $order;

    public $showFooter = true;

    public static $subjectKey = 'emails.order-transport.subject';

    public static $viewKey = 'emails.order-transport-admin';

    public function __construct(OrderTransport $order)
    {
        //
        $this->order = $order;
    }
}
