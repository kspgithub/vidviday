<?php

namespace App\Http\Requests\Tour;

use App\Models\Currency;
use App\Models\Tour;
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
            'seo_text' => ['nullable', 'array'],
            'text' => ['required', 'array'],
            'short_text' => ['nullable', 'array'],
            'video' => ['nullable', 'string'],
            'duration_format' => ['required', Rule::in([Tour::FORMAT_DAYS, Tour::FORMAT_TIME])],
            'duration' => ['required_if:duration_format,==,'.Tour::FORMAT_DAYS],
            'nights' => ['required_if:duration_format,==,'.Tour::FORMAT_DAYS],
            'time' => ['required_if:duration_format,==,'.Tour::FORMAT_TIME],
            'price' => ['required', 'integer'],
            'accomm_price' => ['required', 'integer'],
            'commission' => ['nullable', 'integer'],
            'currency' => ['required', Rule::in(Currency::isoNames())],
            'new' => ['nullable', Rule::in(['1', '0'])],
            'bestseller' => ['nullable', Rule::in(['1', '0'])],
            'published' => ['nullable', Rule::in(['1', '0'])],
            'home_disabled' => ['nullable', Rule::in(['1', '0'])],
            'priority' => ['nullable'],
            'show_map' => ['nullable', Rule::in(['1', '0'])],
            'main_image' => ['nullable', 'string'],
            'badges' => ['nullable', 'array'],
            'staff' => ['nullable', 'array'],
            'mobile_image' => ['nullable', 'string'],
            'directions' => ['nullable', 'array'],
            'groups' => ['nullable', 'array'],
            'events' => ['nullable', 'array'],
            'types' => ['nullable', 'array'],
            'subjects' => ['nullable', 'array'],
            'contact' => ['nullable', 'array'],
            'plan' => ['nullable', 'array'],
            'main_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:500'],
            'mobile_image_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:500'],
            'main_image_alts' => ['nullable', 'array'],
            'main_image_titles' => ['nullable', 'array'],
            'mobile_image_alts' => ['nullable', 'array'],
            'mobile_image_titles' => ['nullable', 'array'],
            'order_enabled' => ['nullable', Rule::in(['1', '0'])],
            'price_for_all_schedules' => ['nullable',  'string'],
            'commission_for_all_schedules' => ['nullable',  'string'],
            'accomm_price_for_all_schedules' => ['nullable',  'string'],
        ];

        foreach ($this->locales as $locale) {
            $rules['title.' . $locale] = ['required'];
            $rules['text.' . $locale] = ['required'];
            $rules['slug.' . $locale] = ['required', new UniqueSlugRule('tours', 'slug', $this->tour->id ?? 0)];
        }

        return $rules;
    }
}
