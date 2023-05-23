<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderNote;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class OrderNoteEmail extends BaseTemplateEmail
{
    public OrderNote $orderNote;

    public Order $order;

    public static $subjectKey = 'emails.order-note.subject';

    public static $viewKey = 'emails.order-note';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OrderNote $orderNote = null)
    {
        $this->orderNote = $orderNote ?: OrderNote::random();
        $this->order = $this->orderNote->order;
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}
