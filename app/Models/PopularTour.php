<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function model()
    {
        return $this->morphTo();
    }

    public function scopeType(Builder $q, $type = null)
    {
        if(is_null($type)) {
            return $q->whereNull('model_type');
        }

        $class = Str::startsWith($type, 'App\\Models\\') ? $type : 'App\\Models\\' . ucwords($type);

        return $q->where('model_type', $class);
    }

    public function scopeModel(Builder $q, $id = null)
    {
        if(is_null($id)) {
            return $q->whereNull('model_id');
        }

        return $q->where('model_id', $id);
    }
}
