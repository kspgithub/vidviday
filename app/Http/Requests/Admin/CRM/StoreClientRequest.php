<?php

namespace App\Http\Requests\Admin\CRM;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUserRequest.
 */
class StoreClientRequest extends FormRequest
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
            'first_name' => ['string', 'max:100', 'required'],
            'last_name' => ['string', 'max:100', 'required'],
            'email' => ['required', 'array'],
            'phone' => ['required', 'array'],
            'email.*' => ['required', 'email'],
            'phone.*' => ['required', 'phone:AUTO'],
        ];
    }
}
