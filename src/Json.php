<?php

namespace PHPToolbox;

class Json
{
    public static function encode($value, $option = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($value, $option);
    }

    /**
     * json解码 弥补PHP将{}解析成[]的问题
     *
     * @param string $json
     * @return array|mixed|object
     */
    public static function decode(string $json)
    {
        return self::objectToArray(json_decode($json));
    }

    public static function isEmptyObject($var): bool
    {
        return is_object($var) && get_object_vars($var) === [];
    }

    /**
     * 对象转数组
     *
     * @param $object
     * @return array|mixed|object
     */
    public static function objectToArray($object)
    {
        $arr = $object;
        if (is_object($object)) {
            $vars = get_object_vars($object);

            $arr = $vars === [] ? (object)$vars : $vars;
        }

        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                $value = (is_array($value) || is_object($value)) ? self::objectToArray($value) : $value;
                $arr[$key] = $value;
            }
        }

        return $arr;
    }
}
