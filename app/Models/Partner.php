<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    protected $fillable = [
        'title',
        'slug',
        'domain',
        'status',
        'tours',
        'config',
    ];


    protected $casts = [
        'tours' => 'array',
        'config' => 'array',
    ];


    public function checkDomain($referer)
    {
        $config = $this->config;
        if ((int)$config['check_domain'] === 0) {
            return true;
        }
        return parse_url($referer, PHP_URL_HOST) === $this->domain;
    }
}
