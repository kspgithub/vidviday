<?php

namespace App\Http\Requests\HtmlBlock;

use Illuminate\Foundation\Http\FormRequest;

class HtmlBlockBasicRequest extends FormRequest
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
            'text' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
        ];
    }
}
