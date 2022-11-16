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
            'type' => ['required', 'numeric', Rule::in([0, 1, 2, 3])],
            'name' => ['required', 'string'],
            'call_date' => ['nullable', 'date_format:d.m.Y'],
            'call_time' => ['nullable'],
            'question_type' => ['nullable'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,rtf,odt', 'max:3072'],
            'phone' => [Rule::requiredIf((int)$this->type === 0 || (int)$this->type === 3)],
            'email' => [Rule::requiredIf((int)$this->type > 0)],
            'comment' => ['nullable'],
            'utm_campaign' => ['nullable'],
            'utm_content' => ['nullable'],
            'utm_medium' => ['nullable'],
            'utm_source' => ['nullable'],
            'utm_term' => ['nullable'],
        ];
    }
}
