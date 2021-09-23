<?php

namespace App\Models;

use App\Models\Traits\UseNormalizeMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class PageSection extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use UseNormalizeMedia;

    public const TYPE_TEXT = 0;
    public const TYPE_VIDEO = 1;
    public const TYPE_GALLERY = 2;


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public $translatable = [
        'content',
    ];

    protected $fillable = [
        'page_id',
        'position',
        'type',
        'content',
    ];


    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
