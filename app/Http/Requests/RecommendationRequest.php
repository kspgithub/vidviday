<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecommendationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.uk' => ['required', 'string'],
            'text' => ['required', 'array'],
            'text.uk' => ['required', 'string'],
            'company' => ['nullable', 'array'],
            'avatar_upload' => ['nullable', 'file', 'max:500'],
            'position' => ['nullable', 'integer'],
            'published' => ['nullable', Rule::in(['0', '1'])],
            'rating' => ['required', Rule::in(['0', '1', '2', '3', '4', '5'])],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
