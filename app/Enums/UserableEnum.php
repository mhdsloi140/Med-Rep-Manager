<?php

namespace App\Enums;

enum UserableEnum: string
{
    case  Admin = 'App\\Models\\Admin';
    case Delegate = 'App\\Models\\Delegate';
    case DelegateSupervisor = 'App\\Models\\DelegateSupervisor';

    public static function fromName($name)
    {
        return constant("self::$name");
    }
}
