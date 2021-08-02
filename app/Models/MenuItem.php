<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    public $translatable = [
        'title',
    ];


    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'position',
        'active',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

}
