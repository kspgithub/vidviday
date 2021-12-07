<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $start
 * @property string $end
 * @property int $tour_id|null
 */
class SearchEventsRequest extends FormRequest
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
            'start' => ['nullable', 'date'],
            'end' => ['nullable', 'date'],
            'date_from' => ['nullable', 'date_format:d.m.Y'],
            'date_to' => ['nullable', 'date_format:d.m.Y'],
            'duration_from' => ['nullable', 'integer', 'min:0'],
            'duration_to' => ['nullable', 'integer'],
            'price_from' => ['nullable', 'integer', 'min:0'],
            'price_to' => ['nullable', 'integer'],
            'direction' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'subject' => ['nullable', 'string'],
            'tour_id' => ['nullable', 'integer'],
            'place_id' => ['nullable', 'integer'],
            'event_click' => ['nullable', 'string'],
        ];
    }
}
