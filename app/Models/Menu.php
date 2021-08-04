<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMenu
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }


}
