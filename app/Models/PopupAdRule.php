<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

class PopupAdRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_type',
        'model_id',
    ];

    public function popup_ad()
    {
        return $this->belongsTo(PopupAd::class);
    }

    public function model()
    {
        return $this->morphTo('model');
    }
}
