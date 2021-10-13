<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeedbackRequest extends FormRequest
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
            'type'=>['required', 'numeric', Rule::in([0,1,2])],
            'name'=>['required', 'string'],
            'call_date'=>['nullable', 'date_format:d.m.Y'],
            'call_time'=>['nullable'],
            'question_type'=>['nullable'],
            'phone'=>[ Rule::requiredIf((int)$this->type === 0)],
            'email'=>[ Rule::requiredIf((int)$this->type > 0)],
            'comment'=>[ Rule::requiredIf((int)$this->type > 2)],
        ];
    }
}
