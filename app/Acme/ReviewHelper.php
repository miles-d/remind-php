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
        $date = Carbon::createFromFormat('Y-m-d', $dateStr);

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
