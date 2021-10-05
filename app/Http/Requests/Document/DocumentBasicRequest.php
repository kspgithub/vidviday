<?php

namespace App\Http\Requests\Document;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentBasicRequest extends FormRequest
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

            'title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'published' => ['nullable', Rule::in(['1', '0'])],
            'file_upload' => ['nullable', 'mimes:jpeg,jpg,png,gif,pdf,doc,docx', 'max:10000'],
        ];
    }
}
