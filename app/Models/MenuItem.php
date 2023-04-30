<?php

namespace App\Models;

use App\Models\Traits\Attributes\MenuItemAttribute;
use App\Models\Traits\Scope\UsePublishedScope;
use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\Traits\HasSlug;
use Illuminate\Support\Str;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class MenuItem extends TranslatableModel
{
    use UsePublishedScope;
    use HasFactory;
    use HasTranslations;
    use MenuItemAttribute;
    use UseSelectBox;

    protected static function boot()
    {
        parent::boot();
        self::saved(function ($model) {
            Cache::forget('header-menu');
        });
        //'header-menu';
    }

    public const SIDE_LEFT = 'left';
    public const SIDE_RIGHT = 'right';

    public static function sides()
    {
        return [
            self::SIDE_LEFT => 'Перша колонка',
            self::SIDE_RIGHT => 'Друга колонка',
        ];
    }

    public $translatable = [
        'title',
        'slug',
    ];

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'model_id',
        'model_type',
        'menu_id',
        'position',
        'side',
        'published',
        'class_name',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function getUrlAttribute()
    {
        return $this->model?->url ?: (!empty($this->slug) ? Str::startsWith($this->slug, 'http',) ? $this->slug : ('/' . $this->slug) : '');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('side')->orderBy('position');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function model()
    {
        return $this->morphTo();
    }
}
