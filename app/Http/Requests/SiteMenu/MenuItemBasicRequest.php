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
            'title'=>['required', 'string'],
            'menu_id'=>['required', 'integer'],
            'parent_id'=>['nullable', 'integer'],
            'slug'=>['nullable', 'string'],
            'active'=>['nullable', Rule::in(['1', '0'])],
            'position'=>['nullable', 'integer'],
        ];
    }
}
