<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TransportDuration extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use UseSelectBox;

    protected $fillable = [
        'title',
        'value',
        'published',
    ];

    public $translatable = [
        'title',
    ];
}
