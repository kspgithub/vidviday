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

        return view('admin.sms-notifications.index', ['notifications' => $notifications]);
    }

    public function edit($key)
    {
        $locales = siteLocales();

        $notification = SmsNotification::query()->where('key', $key)->firstOrFail();

        return view('admin.sms-notifications.edit', [
            'locales' => $locales,
            'notification' => $notification,
        ]);
    }

    public function save($key, SmsNotificationsRequest $request)
    {
        $data = $request->validated();

        $notification = SmsNotification::query()->where('key', $key)->firstOrFail();

        $notification->update($data);

        return redirect()->back()->withFlashSuccess(__('Updated'));
    }
}
