<?php

namespace App\Models;

use App\Models\Traits\UseSelectBox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StaffType extends TranslatableModel
{
    use HasFactory;
    use HasTranslations;
    use UseSelectBox;

    public $translatable = [
        'title',
    ];

    protected $fillable = [
        'title',
        'slug',
    ];

    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'staffs_types', 'type_id', 'staff_id');
    }
}
