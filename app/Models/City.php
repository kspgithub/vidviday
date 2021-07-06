<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory;
    use HasTranslations;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'region_id',
        'country_id',
        'title',
        'slug',
    ];

    public function country()
    {
        $this->belongsTo(Country::class);
    }

    public function region()
    {
        $this->belongsTo(Region::class);
    }
}
