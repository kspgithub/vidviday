<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class TourOrderEmail extends BaseTemplateEmail
{
    use Queueable, SerializesModels;

    public $order;

    public $showFooter = true;

    public static $subjectKey = 'emails.order-tour.subject';

    public static $viewKey = 'emails.order-tour';

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
}
