<?php

namespace App\Enums;

enum TicketableEnum: string
{
    case ADMIN = 'App\\Models\\Admin';
    case DELEGATE = 'App\\Models\\Delegate';
    case DELEGATESUPERVISOR = 'App\\Models\\Category';

    public static function fromName($name)
    {
        return constant("self::$name");
    }
}
