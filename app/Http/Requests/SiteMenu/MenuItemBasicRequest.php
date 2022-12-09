<?php

namespace App\Http\Requests\SiteMenu;

use App\Models\MenuItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuItemBasicRequest extends FormRequest
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
            //
            'title' => ['required', 'array'],
            'title.uk' => ['required', 'string'],
            'slug' => ['required', 'array'],
//            'slug.uk' => ['required', 'string'],
            'active' => ['nullable', Rule::in(['1', '0'])],
            'parent_id' => ['nullable', 'numeric'],
            'page_id' => ['nullable', 'exists:pages,id'],
            'side' => ['nullable', Rule::in([MenuItem::SIDE_LEFT, MenuItem::SIDE_RIGHT])],
        ];
    }
}
