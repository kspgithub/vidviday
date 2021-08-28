<?php

namespace App\Http\Requests\HomePageBanner;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomePageBannerBasicRequest extends FormRequest
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
            'slug' => ['required', 'string'],
            'text' => ['required', 'string'],
            'short_text' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],
            'currency' => ['required', Rule::in(Currency::isoNames())],
            'main_image' => ['nullable', 'string'],
            'main_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
        ];
    }
}
