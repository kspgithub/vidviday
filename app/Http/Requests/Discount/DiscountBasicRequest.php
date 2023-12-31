<?php

namespace App\Http\Requests\Discount;

use App\Models\Currency;
use App\Models\Discount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountBasicRequest extends FormRequest
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
            'title' => [Rule::requiredIf(is_null($this->published)), 'array'],
            'title.uk' => [Rule::requiredIf(is_null($this->published)), 'string'],
            'admin_title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'type' => ['nullable', Rule::in([Discount::TYPE_PERCENT, Discount::TYPE_VALUE])],
            'category' => ['nullable'],
            'duration' => ['nullable'],
            'age_limit' => ['nullable', 'numeric'],
            'age_start' => ['nullable', 'numeric'],
            'age_end' => ['nullable', 'numeric'],
            'price' => [Rule::requiredIf(is_null($this->published)), 'integer'],
            'start_date' => ['nullable', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date_format:Y-m-d'],
            'currency' => [Rule::requiredIf(is_null($this->published)), Rule::in(Currency::isoNames())],
            'published' => ['nullable', Rule::in(['1', '0'])],
        ];
    }
}
