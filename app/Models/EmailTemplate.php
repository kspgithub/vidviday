<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EmailTemplate extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'code',
        'mailable',
        'view',
        'html',
        'subject',
        'mailable',
    ];

    public $translatable = [
        'html',
        'subject',
    ];

    protected $casts = [
        'updated_at' => 'datetime:d.m.Y H:i:s'
    ];
}
