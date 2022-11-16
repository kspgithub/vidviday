<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Advertisement extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use HasImage;

    public $translatable = [
        'title',
        'text',
        'url',
    ];

    protected $fillable = [
        'title',
        'text',
        'url',
        'image',
        'published',
    ];

    protected $appends = [
        'image_url',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];


    public function imageSize()
    {
        return [
            'width' => 260,
            'height' => 260,
        ];
    }
}
