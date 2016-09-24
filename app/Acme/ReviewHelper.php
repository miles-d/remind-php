<?php

namespace App\Acme;

use Carbon\Carbon;

class ReviewHelper
{
    /**
     * Convert ISO date string into readable relative date with Carbon
     */
    public static function readableDate($dateStr)
    {
        if (empty($dateStr)) {
            return 'Mastered';
        }

        $date = Carbon::createFromFormat('Y-m-d', $dateStr);

        /* Customize some of the special dates */
        if ($date->isYesterday()) {
            $readable = "yesterday";
        } elseif ($date->isTomorrow()) {
            $readable = "tomorrow";
        } elseif ($date->isToday()) {
            $readable = "today";
        } else {
            $readable = $date->diffForHumans();
        }

        return $readable;
    }
}
