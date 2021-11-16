<?php

namespace App\Models;

use App\Models\Traits\Attributes\MenuItemAttribute;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

/**
 * Class MenuItem
 *
 * @package App\Models
 * @mixin IdeHelperMenuItem
 */
class MenuItem extends TranslatableModel
{
    use UsePublishedScope;
    use HasFactory;
    use HasTranslations;
    use MenuItemAttribute;
    use UseSelectBox;

    public const SIDE_LEFT = 'left';
    public const SIDE_RIGHT = 'right';

    public $translatable = [
        'title',
        'slug',
    ];


    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'menu_id',
        'position',
        'side',
        'published',
        'class_name',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];


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
