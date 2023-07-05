<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BeWithUs extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use HasImage;

    public $translatable = [
        'title',
        'url',
    ];

    protected $fillable = [
        'title',
        'url',
        'published',
        'position',
        'icon',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

}
