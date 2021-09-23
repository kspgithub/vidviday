<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile_phone' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required', Rule::in(['tourist', 'tour-agent'])],
            'company' => [Rule::requiredIf($this->role === 'tour-agent')],
        ];
    }

    public function messages()
    {
        return [
            'agree' => __('You must accept the privacy policy.'),
        ];
    }
}
