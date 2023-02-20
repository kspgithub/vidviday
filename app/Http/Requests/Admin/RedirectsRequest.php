<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class RedirectsRequest extends FormRequest
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
            'redirects' => 'array',
            'redirects.*.id' => 'required|sometimes',
            'redirects.*.type' => 'required',
            'redirects.*.from' => 'required|string',
            'redirects.*.to' => 'required|string',
            'redirects.*.published' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $entries = $this->get('redirects');

        foreach ($entries as $i => $entry) {
            $entries[$i]['published'] = $entry['published'] ?? 0;
        }

        $this->replace([
            'redirects' => $entries,
        ]);
    }
}
