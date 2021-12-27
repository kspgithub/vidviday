<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    public $order;

    /**
     * @var
     */
    public $notifyMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, string $notifyMessage = '')
    {
        //
        $this->order = $order;
        $this->notifyMessage = $notifyMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-status')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Замовлення туру #' . $this->order->order_number);
    }
}
