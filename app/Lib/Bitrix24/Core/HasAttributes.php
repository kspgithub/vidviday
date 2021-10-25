<?php

namespace App\Lib\Bitrix24\Core;

use Illuminate\Database\Eloquent\JsonEncodingException;

trait HasAttributes
{
    protected $attributes = [];


    public function fill($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->setAttribute($key, $value);
            }
        }
    }

    public function getAttribute($key)
    {

        if (!empty($key)) {
            $key = strtoupper($key);
            if (array_key_exists($key, $this->attributes)) {
                return $this->attributes[$key];
            }

        }
        return null;
    }

    public function setAttribute($key, $value)
    {
        if (!empty($key)) {
            $key = strtoupper($key);
            $this->attributes[$key] = $value;
        }
    }

    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }

    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    public function toArray()
    {
        $props = [];
        foreach ($this->attributes as $key => $value) {
            if (is_array($value)) {
                $props[$key] = [];
                foreach ($value as $val) {
                    $props[$key][] = is_object($val) ? $val->toArray() : $val;
                }
            } elseif (is_object($value)) {
                $props[$key] = $value->toArray();
            } else {
                $props[$key] = $value;
            }
        }
        return $props;
    }

    public function asJson()
    {
        return json_encode($this->jsonSerialize(), JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }
}
