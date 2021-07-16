<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class UploadMediaRequest
 *
 * @property int $model_id
 * @property string $model_type
 * @property string $collection
 * @property string $title
 * @property string $alt
 * @property UploadedFile $media_file
 *
 * @package App\Http\Requests
 */
class UploadMediaRequest extends FormRequest
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
            'model_type'=>['required', 'string'],
            'model_id'=>['required', 'integer'],
            'media_file'=>['required', 'file'],
            'collection'=>['nullable', 'string'],
            'title'=>['nullable', 'string'],
            'alt'=>['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'media_file'=>__('No file'),
        ]);
    }
}
