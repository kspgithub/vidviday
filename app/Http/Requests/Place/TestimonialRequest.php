<?php

namespace App\Http\Requests\Place;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $tour_id
 */
class TestimonialRequest extends FormRequest
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
            //
            'first_name' => ['required', 'max:100'],
            'last_name' => ['required', 'max:100'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'text' => ['required', 'max:1000'],
            'parent_id' => ['nullable', 'integer'],
            'tour_id' => ['nullable', 'integer'],
            'rating' => ['nullable', 'integer'],
            'avatar_upload' => ['nullable', 'image', 'max:500'],
            'images_upload.*' => ['nullable', 'image', 'max:3000'],
        ];
    }
}
