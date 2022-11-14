<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $this->merge([
            'birthday' => ! empty($this->birthday) ? Carbon::createFromFormat('d.m.Y', $this->birthday) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'first_name' => ['required'],
            'last_name' => ['required'],
            'middle_name' => ['nullable'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(current_user()->id)],
            'mobile_phone' => ['required'],
            'birthday' => ['nullable'],
            'viber' => ['nullable'],
            'avatar_upload' => ['mimes:jpg,jpeg,png', 'max:2048'],
            'new_password' => ['nullable', 'same:password_confirmation'],
            'current_password' => ['nullable', Rule::requiredIf(! empty($this->new_password))],
            'password_confirmation' => ['nullable', Rule::requiredIf(! empty($this->new_password))],
            'company' => ['nullable', Rule::requiredIf(current_user()->role === 'tour-agent')],
            'address' => ['nullable', Rule::requiredIf(current_user()->role === 'tour-agent')],
            'position' => ['nullable'],
            'website' => ['nullable', 'url'],
            'work_email' => ['nullable', 'email'],
        ];
    }
}
