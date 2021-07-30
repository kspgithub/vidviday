<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class TourAccommodation
 * Проживание тура
 *
 * @package App\Models
 * @mixin IdeHelperTourAccommodation
 */
class TourAccommodation extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'description',
    ];


    protected $fillable = [
        'tour_id',
        'accommodation_id',
        'type_id',
        'title',
        'text',
        'slug',
    ];


    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id');
    }

    public function type()
    {
        return $this->belongsTo(AccommodationType::class, 'type_id');
    }
}
