<?php

namespace App\Mail;

use App\Models\OrderTransport;
use Illuminate\Mail\Mailable;

class OrderTransportAdminMail extends Mailable
{
    public $order;

    public $showFooter = true;

    public function __construct(OrderTransport $order)
    {
        //
        $this->order = $order;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Нове замовлення транспорту на Vidiviay.ua')
            ->view('emails.order-transport-admin');
    }
}
