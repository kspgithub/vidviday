<?php

namespace App\Models;

use App\Models\Traits\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Recommendation extends TranslatableModel
{
    use HasFactory;
    use HasAvatar;
    use HasTranslations;


    public $translatable = [
        'name',
        'company',
        'text',
    ];

    protected $fillable = [
        'published',
        'rating',
        'avatar',
        'name',
        'company',
        'text',
        'sort_order',
    ];

    protected $appends = [
        'initials',
        'avatar_url',
        'date',
        'time',
    ];


    protected $casts = [
        'published' => 'boolean'
    ];


    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
