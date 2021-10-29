<?php

namespace App\Http\Requests\Ticket;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketBasicRequest extends FormRequest
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
            'title' => ['required', 'array'],
            'title.uk' => ['required', 'string'],
            'text' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],
            'region_id' => ['required', 'integer'],
            'currency' => ['required', Rule::in(Currency::isoNames())],
            'published' => ['nullable', Rule::in(['1', '0'])],

        ];
    }
}
