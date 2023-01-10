<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notifications\SmsNotificationsRequest;
use App\Models\SmsNotification;
use Illuminate\Http\Request;

class SmsNotificationsController extends Controller
{
    public function index()
    {
        $notifications = SmsNotification::query()->get();

        $replaces = config('notifications.sms');

        foreach ($notifications as $notification) {
            $notification->replaces = $replaces[$notification->key]['replaces'] ?? [];
        }

        return view('admin.notifications.sms', ['notifications' => $notifications]);
    }

    public function save(SmsNotificationsRequest $request)
    {
        $data = $request->validated();

        $notifications = SmsNotification::query()->get();

        foreach ($data['notifications'] as $key => $item) {
            /**
             * @var $notification SmsNotification
             */
            $notification = $notifications->where('key', $key)->first();

            if($notification) {
                $notification->update($item);
            }
        }

        return redirect()->back()->with('success', __('Updated'));
    }
}
