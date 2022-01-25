<?php

namespace App\Mail;

use App\Models\OrderCertificate;
use App\Models\Staff;
use App\Services\MailNotificationService;
use Illuminate\Mail\Mailable;

class OrderCertificateAdminMail extends Mailable
{
    public $order;

    public $showFooter = true;

    public function __construct(OrderCertificate $order)
    {
        //
        $this->order = $order;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Нове замовлення сертифікату на Vidiviay.ua')
            ->view('emails.order-certificate-admin');
    }
}
