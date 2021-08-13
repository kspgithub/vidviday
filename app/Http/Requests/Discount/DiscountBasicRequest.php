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
            'title' => ['required', 'string'],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'model_nameable_id' => ['required', 'integer'],
            'model_nameable_type' => ['required', 'string'],
            'currency' => ['required', Rule::in(Currency::isoNames())],
        ];
    }
}
