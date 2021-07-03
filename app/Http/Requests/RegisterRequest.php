<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 *
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 * @property boolean $agree
 *
 * @package App\Http\Requests\Auth
 */
class RegisterRequest extends FormRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'agree' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'agree' => __('You must accept the privacy policy.'),
        ];
    }
}
