<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchToursRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'q' => ['nullable', 'string'],
            'date_from' => ['nullable', 'date_format:d.m.Y'],
            'date_to' => ['nullable', 'date_format:d.m.Y'],
            'duration_from' => ['nullable', 'integer', 'min:0'],
            'duration_to' => ['nullable', 'integer'],
            'price_from' => ['nullable', 'integer', 'min:0'],
            'price_to' => ['nullable', 'integer'],
            'direction' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'subject' => ['nullable', 'string'],
            'place' => ['nullable', 'string'],
            'landing' => ['nullable', 'string'],
            'page' => ['nullable', 'integer'],
            'future' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer'],
            'sort_by' => ['nullable', Rule::in(['price', 'crated', 'rating'])],
            'sort_dir' => ['nullable', Rule::in(['asc', 'desc'])],
            'lang' => ['nullable', Rule::in(siteLocales())],
        ];
    }
}
