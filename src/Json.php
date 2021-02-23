<?php

namespace PHPToolbox;

class Json
{
    public static function encode($value, $option = JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES)
    {
        return json_encode($value, $option);
    }

    public static function decode($data)
    {
        return json_decode($data, true);
    }
}
