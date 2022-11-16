<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class OrderStatusEmail extends BaseTemplateEmail
{
    public Order $order;

    public string $notifyMessage;

    public static $subjectKey = 'emails.order-status.subject';

    public static $viewKey = 'emails.order-status';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order = null, string $notifyMessage = '')
    {
        $this->order = $order ?: Order::random();
        $this->notifyMessage = $notifyMessage;
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}
