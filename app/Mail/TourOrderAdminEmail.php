<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class TourOrderAdminEmail extends BaseTemplateEmail
{
    public Order $order;

    public static $subjectKey = 'emails.order-tour-admin.subject';

    public static $viewKey = 'emails.order-tour-admin';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order = null)
    {
        $this->order = $order ?: new Order();
    }
}
