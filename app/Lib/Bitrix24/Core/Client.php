<?php

namespace App\Lib\Bitrix24\Core;

use Illuminate\Support\Facades\Http;

class Client
{
    protected static $instance;

    private $url;

    private $token;

    private $response;

    public function __construct()
    {
        $this->url = config('services.bitrix24.domain') . '/rest';
        $this->token = config('services.bitrix24.token');
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getUrl($bitrixMethod, $params = [])
    {
        return $this->url . '/' . $bitrixMethod . '?auth=' . $this->token;
    }


    public function request($bitrixMethod, $params = [], $httpMethod = 'GET')
    {
        $url = $this->getUrl($bitrixMethod, $params);
        if (strtoupper($httpMethod) === 'POST') {
            $this->response = Http::post($url, $params);
        } else {
            $this->response = Http::get($url, $params);
        }
    }

    public function getResponse()
    {
        return $this->response;
    }

    public static function get($bitrixMethod, $params = [])
    {
        $instance = self::getInstance();
        $instance->request($bitrixMethod, $params);
        return $instance->getResponse();
    }

    public static function post($bitrixMethod, $params = [])
    {
        $instance = self::getInstance();
        $instance->request($bitrixMethod, $params, 'POST');
        return $instance->getResponse();
    }
}
