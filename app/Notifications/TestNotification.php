<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\TurboSMS\TurboSMSMessage;

class TestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $text;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($text = 'Vidviday test message!')
    {
        //
        $this->text = $text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['turbosms'];
    }

    public function toTurboSMS($notifiable)
    {
        return (new TurboSMSMessage($this->text));
    }
}
