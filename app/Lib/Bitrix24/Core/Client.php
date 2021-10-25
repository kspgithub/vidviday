<?php

namespace App\Lib\Bitrix24\Core;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Client
{
    protected static $instance;

    private $url;

    /**
     * @var Response
     */
    private $response;

    public function __construct()
    {
        $url = rtrim(config('services.bitrix24.domain'), "/") . '/rest';
        $user = config('services.bitrix24.user');
        $token = config('services.bitrix24.token');

        $this->url = $url . '/' . $user . '/' . $token;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getUrl($bitrixMethod)
    {
        return $this->url . '/' . $bitrixMethod;
    }


    private function request($bitrixMethod, $params = [], $httpMethod = 'GET')
    {
        $url = $this->getUrl($bitrixMethod);
        if (strtoupper($httpMethod) === 'POST') {
            $this->response = Http::post($url, $params);
        } else {

            $this->response = Http::get($url, http_build_query($params));
        }
    }

    public function getJson()
    {
        $status = $this->response->status();
        if ($status === 200) {
            return $this->response->json();
        }
        return null;
    }

    public static function get($bitrixMethod, $params = [])
    {
        $instance = self::getInstance();
        $instance->request($bitrixMethod, $params);
        return $instance->getJson();
    }

    public static function post($bitrixMethod, $params = [])
    {
        $instance = self::getInstance();
        $instance->request($bitrixMethod, $params, 'POST');
        return $instance->getJson();
    }

}
