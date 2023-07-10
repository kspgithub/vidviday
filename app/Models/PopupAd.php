<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

class PopupAd extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;
    use HasImage;

    public $translatable = [
        'title',
        'text',
        'url',
    ];

    protected $fillable = [
        'title',
        'text',
        'url',
        'image',
        'timeout',
        'published',
        'pages',
        'starts_at',
    ];

    protected $appends = [
        'image_url',
    ];

    protected $casts = [
        'published' => 'boolean',
        'pages' => 'array',
    ];

    public function rules()
    {
        return $this->hasMany(PopupAdRule::class);
    }

    public function getStartsAtAttribute($starts_at)
    {
        return Carbon::parse($starts_at)->format('d.m.Y');
    }

    public function setStartsAtAttribute($starts_at)
    {
        $this->attributes['starts_at'] = Carbon::parse($starts_at);
    }

    public function scopeForModel(Builder $q, Model $model)
    {
        $q->join('popup_ad_rules', 'popup_ads.id', '=', 'popup_ad_rules.popup_ad_id')
            ->where('popup_ad_rules.model_type', $model::class)
            ->whereIn('popup_ad_rules.model_id', [$model->id, 0]);
    }

    public function imageSize()
    {
        return [
            'width' => 1000,
            'height' => 1000,
        ];
    }
}
