<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use HasImage;

    public $translatable = [
        'title',
        'text',
        'url',
        'price_comment',
        'image_title',
        'image_alt',
        'label',
    ];

    protected $fillable = [
        'title',
        'text',
        'url',
        'show_price',
        'price',
        'price_comment',
        'currency',
        'image',
        'image_title',
        'image_alt',
        'published',
        'label',
        'color',
        'position',
    ];

    protected $appends = [
        'image_url',
    ];

    protected $casts = [
        'published' => 'boolean',
        'show_price' => 'boolean',
        'price' => 'integer',
    ];

    public function imageSize()
    {
        return [
            'width' => 948,
            'height' => 516,
        ];
    }

    public function getImageWidthAttribute()
    {
        return $this->imageSize()['width'];
    }

    public function getImageHeightAttribute()
    {
        return $this->imageSize()['height'];
    }
}
