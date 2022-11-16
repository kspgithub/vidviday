<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourFaq extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;


    public $translatable = [
        'question',
        'answer',
    ];

    protected $fillable = [
        'tour_id',
        'section',
        'question',
        'answer',
        'sort_order',
        'published',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
