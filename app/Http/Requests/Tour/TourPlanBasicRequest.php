<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourPlanBasicRequest extends FormRequest
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
            'text'=>['nullable', 'string'],
            'tour_id'=>['required', 'integer'],
            'lat'=>['nullable', 'string'],
            'lng'=>['nullable', 'string'],
            'published'=>['nullable', Rule::in(['1', '0'])],

        ];
    }
}
