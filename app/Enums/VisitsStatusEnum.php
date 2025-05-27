<?php

namespace App\Enums;

enum VisitsStatusEnum: int
{
    case PENDING = 1;
    case DONE = 2;
    case CANCELED = 3;
    case POSTPONE=4;


    public static function fromName($name)
    {
        return constant("self::$name");
    }
}
