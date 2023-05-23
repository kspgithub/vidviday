<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class TourOrderEmail extends BaseTemplateEmail
{
    public Order $order;

    public static $subjectKey = 'emails.order-tour.subject';

    public static $viewKey = 'emails.order-tour';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order = null)
    {
        $this->order = $order ?: Order::random();
    }

    public function getReplaces(): array
    {
        return [
            'order_id' => $this->order->id,
            'departure_date' => fn() => $this->order->start_date?->format('d.m.Y'),
            'tour_name' => $this->order->tour->title ?? ' Корпоративний тур',
            'first_name' => $this->order->first_name,
            'last_name' => $this->order->last_name,
            'status' => $this->order->status_text,
        ];
    }
}
