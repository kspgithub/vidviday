<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $guide_id
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
            'tour_id' => ['sometimes', 'required', 'integer', 'exists:tours,id'],
            'guide_id' => ['nullable', 'integer'],
            'rating' => ['nullable', 'integer'],
            'avatar_upload' => ['nullable', 'image', 'max:1024', 'dimensions:width=200,height=200'],
            'images_upload.*' => ['nullable', 'image', 'max:1024'],
        ];
    }

    public function attributes()
    {
        return [
            'avatar_upload' => 'avatar',
            'images_upload.*' => 'images',
        ];
    }
}
