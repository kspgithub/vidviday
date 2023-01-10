<?php

namespace App\Http\Requests\Admin\Notifications;

use Illuminate\Foundation\Http\FormRequest;

class SmsNotificationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'notifications' => 'required|array',
            'notifications.*.key' => 'required|string',
            'notifications.*.title' => 'required|string',
            'notifications.*.text' => 'required|string',
            'notifications.*.phone' => 'required|boolean',
            'notifications.*.viber' => 'required|boolean',
        ];
    }
}
