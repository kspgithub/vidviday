<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TourOrderAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emails = [site_option('order_email')];

        if ($this->order->tour && $this->order->tour->staff  && !empty($this->order->tour->staff->email)) {
            $emails[] = $this->order->tour->staff->email;
        }

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($emails)
            ->subject('Нове замовлення на Vidiviay.ua')
            ->view('emails.order-tour');
    }
}
