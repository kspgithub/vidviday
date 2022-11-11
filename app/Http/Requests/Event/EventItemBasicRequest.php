<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventItemBasicRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'seo_h1' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string'],
            'seo_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string'],
            'text' => ['nullable', 'string'],
            'group_id' => ['nullable', 'integer'],
            'direction_id' => ['nullable', 'integer'],
            'event_id' => ['required', 'integer'],
            'published' => ['nullable', Rule::in(['1', '0'])],
            'indefinite' => ['nullable', Rule::in(['1', '0'])],
            'start_date' => ['nullable', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date_format:Y-m-d'],
            'main_image' => ['nullable', 'string'],
            'mobile_image' => ['nullable', 'string'],
            'main_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
            'mobile_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
        ];
    }
}
