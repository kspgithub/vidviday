<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $text
 * @property int $parent_id
 */
class TourQuestionRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'text' => ['required', 'max:1000'],
            'parent_id' => ['nullable', 'integer'],
        ];
    }
}
