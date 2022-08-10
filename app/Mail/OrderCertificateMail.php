<?php

namespace App\Mail;

use App\Models\OrderCertificate;

class OrderCertificateMail extends BaseTemplateEmail
{
    public $order;

    public $showFooter = true;

    public static $subjectKey = 'emails.order-certificate.subject';

    public static $viewKey = 'emails.order-certificate';

    public function __construct(OrderCertificate $order)
    {
        //
        $this->order = $order;
    }
}
