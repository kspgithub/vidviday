<?php

namespace App\Models;

use App\Models\Traits\HasTranslatableSlug;
use App\Models\Traits\Methods\HasJsonSlug;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseNormalizeMedia;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class TourGroup extends TranslatableModel implements HasMedia
{
    use HasFactory;
    use HasTranslatableSlug;
    use HasJsonSlug;
    use HasTranslations;
    use UsePublishedScope;
    use InteractsWithMedia;
    use UseNormalizeMedia;
    use UseSelectBox;

    public $translatable = [
        'title',
        'slug',
        'text',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
    ];

    protected $fillable = [
        'title',
        'seo_h1',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_text',
        'text',
        'slug',
        'published',
    ];

    protected $appends = [
        'url',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tours_tour_groups', 'group_id', 'tour_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('normal')
            ->width(840)
            ->height(480);

        $this->addMediaConversion('thumb')
            ->width(315)
            ->height(180);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;
        $slugString = $this->getSlugSourceString();

        $slug = $this->getTranslations($slugField)[$this->getLocale()] ?? null;

        $hasCustomSlug = $this->hasCustomSlugBeenUsed() && ! empty($slug);
//        $hasNonChangedCustomSlug = !$this->slugIsBasedOnTitle() && !empty($slug);

        if ($hasCustomSlug/* || $hasNonChangedCustomSlug*/) {
            $slugString = $slug;

            $slugString = Str::replace(' ', $this->slugOptions->slugSeparator, $slugString);

            // Split slug by uppercase chars
            $parts = preg_split('/(?=[A-Z])/', $slugString);

            if (count($parts) > 1) {
                $resultSlug = '';

                foreach ($parts as $part) {
                    $firstLetter = mb_substr($part, 0, 1);
                    $lastLetter = mb_substr($part, -1);
                    $word = substr($part, 1);
                    $resultSlug .= $firstLetter
                        .Str::slug($word, $this->slugOptions->slugSeparator, $this->slugOptions->slugLanguage)
                        .(in_array($lastLetter, ['-', '_']) ? $lastLetter : '');
                }
            }

            return $slugString;
        }

        return Str::slug($slugString, $this->slugOptions->slugSeparator, $this->slugOptions->slugLanguage);
    }

    public function getUrlAttribute()
    {
        return ! empty($this->slug) ? '/'.$this->slug : '';
    }
}
