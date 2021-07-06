<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
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
        'country_id',
        'title',
        'slug',
    ];

    public function cities()
    {
        $this->hasMany(City::class);
    }

    public function country()
    {
        $this->belongsTo(Country::class);
    }
}
