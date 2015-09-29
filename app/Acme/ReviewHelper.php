<?php

namespace App\Acme;

class ReviewHelper
{
	public static function getNextReviewDate($newLevel)
	{
		$steps = [1, 7, 30, 90, 180, 365];
		$nextReviewDate = new \DateTime($steps[$newLevel] . ' days');

		return $nextReviewDate->format('Y-m-d');
	}

	/**
	 * Convert ISO date string into readable relative date
	 *
	 * '2015-09-30' -> '15 days'
	 */
	public static function readableDate($dateStr)
	{
		$date = new \DateTime($dateStr);
		$today = new \DateTime;
		$tomorrow = new \DateTime('tomorrow');
		$yesterday = new \DateTime('yesterday');
		$diff = $today->diff($date);

		if ($date->format('Y-m-d') == $today->format('Y-m-d')) {

			$readable = 'today';

		} elseif ($date->format('Y-m-d') == $tomorrow->format('Y-m-d')) {

			$readable = 'tomorrow';

		} elseif ($date->format('Y-m-d') == $yesterday->format('Y-m-d')) {

			$readable = 'yesterday';

		} elseif ($diff->format('%a') < 14) {

			// if sooner than two weeks, show like '12 days'

			$readable = $diff->d . ' days';

		} elseif ($diff->format('%a') < 61) {

			// if sooner than two months, but longer than 2 weeks,
			// show like '5 weeks'

			$readable = floor($diff->format('%a') / 7) . ' weeks';

		} elseif ($diff->format('%a') < 730) {

			// If sooner than two years, but longer than 2 months,
			// show like '15 months'

			$readable = $diff->y * 12 + $diff->format('%m') . ' months';

		} else {

			// If later than 2 years, show like '4 years'

			$readable = $diff->format('%y') . ' years';

		}

		// If the date was in the past, append ' ago' (unless it is already relative, like 'yesterday')
		if ($diff->format('%r') == '-' && $readable !== 'yesterday' && $readable !== 'today') {
			$readable .= ' ago';
		}

		return $readable;
	}
}
