<?php

namespace App\Services;

class TtlFactory
{
    public static function minutes(int $seconds): int
    {
        return $seconds * 60;
    }

    public static function hours(int $hours): int
    {
        return self::minutes(60) * $hours;
    }

    public static function days(int $days): int
    {
        return self::hours(24) * $days;
    }
}
