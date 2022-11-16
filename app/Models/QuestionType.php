<?php

namespace App\Models;

use App\Models\Traits\Scope\UsePublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class QuestionType extends Model
{
    use HasFactory;
    use HasTranslations;
    use UsePublishedScope;

    protected $fillable = [
        'type',
        'title',
        'manager_id',
        'email',
        'published',
    ];

    public $translatable = [
        'title',
    ];

    protected static function boot()
    {
        parent::boot();

        self::saving(function (self $questionType) {
            if(!$questionType->email && $questionType->manager) {
                $questionType->email = $questionType->manager->email;
            }
        });
    }

    public function manager()
    {
        return $this->belongsTo(Staff::class, 'manager_id');
    }

    public function asSelectBox(
        $value_key = 'value',
        $text_key = 'title'
    )
    {
        return [
            $value_key => $this->id,
            $text_key => $this->title,
        ];
    }
}
