<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularTour extends Model
{
    use HasFactory;
    use UsePublishedScope;

    protected $fillable = [
        'tour_id',
        'position',
        'published',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
