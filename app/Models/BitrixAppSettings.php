<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitrixAppSettings extends Model
{

    protected $fillable = [
        'access_token',
        'expires',
        'expires_in',
        'scope',
        'domain',
        'server_endpoint',
        'status',
        'client_endpoint',
        'member_id',
        'user_id',
        'refresh_token',
        'application_token',
    ];


}
