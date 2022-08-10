<?php

namespace App\Mail;

use App\Models\OrderTransport;

class OrderTransportMail extends BaseTemplateEmail
{
    public $order;

    public $showFooter = true;

    public static $subjectKey = 'emails.registration.subject';

    public static $viewKey = 'emails.registration';

    public function __construct(OrderTransport $order)
    {
        //
        $this->order = $order;
    }
}
