<?php

namespace App\Acme;

use Carbon\Carbon;

class ReviewHelper
{
	public static function getNextReviewDate($newLevel)
	{
		$steps = [1, 7, 30, 90, 180, 365];
		$nextReviewDate = new \DateTime($steps[$newLevel] . ' days');

		return $nextReviewDate->format('Y-m-d');
	}

	/**
	 * Convert ISO date string into readable relative date with Carbon
	 *
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
