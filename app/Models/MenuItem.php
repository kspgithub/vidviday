<?php

namespace App\Models;

use App\Models\Traits\Attributes\MenuItemAttribute;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class MenuItem
 * @package App\Models
 * @mixin IdeHelperMenuItem
 */
class MenuItem extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use HasSlug;
    use MenuItemAttribute;
    use UseSelectBox;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];


    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'menu_id',
        'position',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['title'])
            //->usingLanguage('uk')
            ->saveSlugsTo('slug');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
}
