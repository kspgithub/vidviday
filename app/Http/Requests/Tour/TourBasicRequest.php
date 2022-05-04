<?php

namespace App\Http\Requests\Tour;

use App\Models\Currency;
use App\Rules\TranslatableSlugRule;
use App\Rules\UniqueSlugRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourBasicRequest extends FormRequest
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

        $rules = [
            //
            'locales' => ['required', 'array'],
            'title' => ['required', 'array'],
            'manager_id' => ['nullable', 'string'],
            'bitrix_id' => ['nullable', 'string'],
            'bitrix_manager_id' => ['nullable', 'string'],
            'slug' => ['nullable', 'array', new TranslatableSlugRule()],
            'seo_h1' => ['nullable', 'array'],
            'seo_title' => ['nullable', 'array'],
            'seo_description' => ['nullable', 'array'],
            'seo_keywords' => ['nullable', 'array'],
            'text' => ['required', 'array'],
            'short_text' => ['nullable', 'array'],
            'video' => ['nullable', 'string'],
            'duration' => ['required', 'integer'],
            'nights' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'accomm_price' => ['required', 'integer'],
            'commission' => ['nullable', 'integer'],
            'currency' => ['required', Rule::in(Currency::isoNames())],
            'new' => ['nullable', Rule::in(['1', '0'])],
            'bestseller' => ['nullable', Rule::in(['1', '0'])],
            'published' => ['nullable', Rule::in(['1', '0'])],
            'show_map' => ['nullable', Rule::in(['1', '0'])],
            'main_image' => ['nullable', 'string'],
            'badges' => ['nullable', 'array'],
            'staff' => ['nullable', 'array'],
            'mobile_image' => ['nullable', 'string'],
            'directions' => ['nullable', 'array'],
            'groups' => ['nullable', 'array'],
            'types' => ['nullable', 'array'],
            'subjects' => ['nullable', 'array'],
            'contact' => ['nullable', 'array'],
            'plan' => ['nullable', 'array'],
            'main_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
            'mobile_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:10000'],
            'main_image_alts' => ['nullable', 'array'],
            'main_image_titles' => ['nullable', 'array'],
            'mobile_image_alts' => ['nullable', 'array'],
            'mobile_image_titles' => ['nullable', 'array'],
        ];

        foreach ($this->locales as $locale) {
            $rules['title.' . $locale] = ['required'];
            $rules['text.' . $locale] = ['required'];
            $rules['slug.' . $locale] = ['required', new UniqueSlugRule('tours', 'slug', $this->tour->id ?? 0)];
        }

        return $rules;
    }
}
