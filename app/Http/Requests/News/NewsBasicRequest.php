<?php

namespace App\Http\Requests\News;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsBasicRequest extends FormRequest
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
            'title'=>['required', 'string'],
            'slug'=>['nullable', 'string'],
            'published'=>['nullable', Rule::in(['1', '0'])],
            'seo_h1'=>['nullable', 'string'],
            'seo_title'=>['nullable', 'string'],
            'seo_description'=>['nullable', 'string'],
            'seo_keywords'=>['nullable', 'string'],
            'text'=>['required', 'string'],
            'short_text'=>['nullable', 'string'],
            'main_image'=>['nullable', 'string'],
            'mobile_image'=>['nullable', 'string'],
            'main_image_upload'=>['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
            'mobile_image_upload'=>['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
        ];
    }
}
