<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public static function allNames()
    {
        return self::pluck('name')->toArray();
    }

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'guard_name',
    ];


    public static function toSelectBox()
    {
        return self::all()->map(fn ($role) => ['value' => $role->id, 'text' => __(Str::ucfirst(str_replace('-', ' ', $role->name)))]);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_role', 'page_id', 'role_id');
    }
}
