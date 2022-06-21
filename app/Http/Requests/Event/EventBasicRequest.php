<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventBasicRequest extends FormRequest
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
            'seo_text' => ['nullable', 'array'],
            'text' => ['required', 'array'],
            'text.uk' => ['required', 'string'],
            'short_text' => ['nullable', 'array'],
            'groups' => ['required', 'array'],
            'directions' => ['required', 'array'],
            'published' => ['nullable', Rule::in(['1', '0'])],
            'indefinite' => ['nullable', Rule::in(['1', '0'])],
            'start_date' => ['nullable', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date_format:Y-m-d'],
        ];
    }
}
