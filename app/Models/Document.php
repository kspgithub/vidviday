<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Document
 *
 * @package App\Models
 * @mixin IdeHelperDocument
 */
class Document extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'image',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];
}
