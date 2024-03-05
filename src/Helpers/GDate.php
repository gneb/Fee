<?php

declare(strict_types=1);

namespace Gneb\Fee\Helpers;

class GDate
{
    public static function getWeekNumber(string $date)
    {
        return date('W', strtotime($date));
    }
}
