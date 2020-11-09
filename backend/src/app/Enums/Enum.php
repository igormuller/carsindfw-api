<?php

namespace App\Enums;

abstract class Enum
{
    public static function getAttributes($myClass)
    {
        $attributes = new \ReflectionClass($myClass);
        return $attributes->getConstants();
    }

    public static function getAttribute($attribute, $class)
    {
        $attributes = new \ReflectionClass($class);
        $list = $attributes->getConstants();
        if (!self::isValid($attribute)) {
            return false;
        }

        return $list[$attribute];
    }

    public static function isValid($attribute)
    {
        if (!defined("static::".$attribute)) {
            return false;
        }

        return true;
    }
}
