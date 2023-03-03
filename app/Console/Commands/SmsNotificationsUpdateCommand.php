<?php

namespace App\Console\Commands;

use App\Models\SmsNotification;
use Illuminate\Console\Command;

class SmsNotificationsUpdateCommand extends Command
{
    protected $signature = 'sms:notifications-update';

    protected $description = 'Command description';

    public function handle(): void
    {
        $notifications = SmsNotification::all();
        foreach ($notifications as $notification) {
            $attributes = $notification->getAttributes();
            $title = $attributes['title'];
            $text = $attributes['text'];

            $notification->setTranslation('title', 'uk', $title);
            $notification->setTranslation('text', 'uk', $text);
            $notification->save();
        }
    }
}
