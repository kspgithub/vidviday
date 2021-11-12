<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventGroupBasicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'array'],
            'title.uk' => ['required', 'string'],
            'slug' => ['nullable', 'array'],
            'seo_h1' => ['nullable', 'array'],
            'seo_title' => ['nullable', 'array'],
            'seo_description' => ['nullable', 'array'],
            'seo_keywords' => ['nullable', 'array'],
            'text' => ['nullable', 'array'],
        ];
    }
}
