<?php

namespace App\Http\Requests\Charity;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CharityBasicRequest extends FormRequest
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
            //
            'title' => ['required', 'array'],
            'title.uk' => ['required', 'string'],
            'slug' => ['nullable', 'array'],
            'slug.uk' => ['nullable', 'string'],
            'published' => ['nullable', Rule::in(['1', '0'])],
            'seo_h1' => ['nullable', 'array'],
            'seo_title' => ['nullable', 'array'],
            'seo_description' => ['nullable', 'array'],
            'seo_keywords' => ['nullable', 'array'],
            'seo_text' => ['nullable', 'array'],
            'text' => ['required', 'array'],
            'text.uk' => ['required', 'string'],
            'short_text' => ['nullable', 'array'],
            'main_image' => ['nullable', 'string'],
            'mobile_image' => ['nullable', 'string'],
            'main_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:500'],
            'mobile_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:500'],
        ];
    }
}
