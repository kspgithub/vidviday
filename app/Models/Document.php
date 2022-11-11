<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\StandardUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Document extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use StandardUploadFile;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'image',
        'file',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];
}
