<?php

namespace App\Models;

use App\Models\Traits\Attributes\MenuAttribute;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Menu extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use MenuAttribute;
    use UseSelectBox;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
        'description',
    ];

    protected $fillable = [
        'title',
        'description',
        'slug',
    ];


    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->orderBy('position');
    }

}
