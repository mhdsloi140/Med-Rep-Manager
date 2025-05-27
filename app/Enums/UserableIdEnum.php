<?php

namespace App\Enums;

enum UserableIdEnum: int
{
    case SuperAdmin = 1;
    case Admin = 2;
    case Delegate = 3;

    public static function fromName($name)
    {
        return constant("self::$name");
    }
}
    