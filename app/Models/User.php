<?php

namespace App\Models;

use App\Models\Traits\Attributes\UserAttributes;
use App\Models\Traits\HasAvatar;
use App\Models\Traits\Methods\UserMethod;
use App\Models\Traits\Relationship\UserRelationship;
use App\Models\Traits\Scope\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use UserMethod;
    use UserAttributes;
    use UserScope;
    use UserRelationship;
    use HasAvatar;
    use SoftDeletes;

    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_BLOCKED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'email',
        'password',
        'mobile_phone',
        'work_phone',
        'work_email',
        'avatar',
        'viber',
        'company',
        'address',
        'position',
        'website',
        'bitrix_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'avatar',
        'name',
        'bitrix_id',
    ];

    protected $appends = [
        'avatar_url',
        'role',
        'initials',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date:d.m.Y',
    ];

    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
    ];

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
