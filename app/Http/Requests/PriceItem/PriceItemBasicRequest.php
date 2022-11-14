<?php

namespace App\Http\Requests\PriceItem;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PriceItemBasicRequest extends FormRequest
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
            'limited' => ['required', Rule::in(['1', '0'])],
            'published' => ['required', Rule::in(['1', '0'])],
            'price' => ['nullable', 'integer'],
            'places' => ['nullable', 'integer'],
            'tour_id' => ['required', 'integer'],
            'currency' => ['required', Rule::in(Currency::isoNames())],
        ];
    }
}
