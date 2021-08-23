<?php

namespace App\Http\Requests\Discount;

use App\Models\Currency;
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
            'title'=>['required', 'string'],
            'slug'=>['nullable', 'string'],
            'percentage'=>['nullable', 'integer'],
            'price'=>['required', 'integer'],
            'start_date'=>['nullable', 'date_format:Y-m-d'],
            'end_date'=>['nullable', 'date_format:Y-m-d'],
            'currency'=>['required', Rule::in(Currency::isoNames())],
            'published'=>['nullable', Rule::in(['1', '0'])],
        ];
    }
}
