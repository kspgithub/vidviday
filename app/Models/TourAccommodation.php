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
        'text',
        'title',
    ];


    protected $fillable = [
        'tour_id',
        'accommodation_id',
        'title',
        'text',
    ];


    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class, 'accommodation_id');
    }

    public function types()
    {
        return $this->belongsToMany(AccommodationType::class, 'tour_accomm_types', 'accomm_id', 'type_id');
    }
}
