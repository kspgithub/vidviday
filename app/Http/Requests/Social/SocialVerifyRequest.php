<?php

namespace App\Http\Requests\Social;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SocialVerifyRequest extends FormRequest
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
            'csrf_token' => 'required',
            'credential' => 'required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'csrf_token' => $this->getCsrfToken(),
            'state' => 'ok',
        ]);
    }


    /**
     * Get csrf token.
     *
     * @return string|null
     */
    protected function getCsrfToken(): string|null
    {
        return collect($this->keys())->filter(function($key){
            return Str::is('*csrf_token', $key);
        })->first();
    }
}
