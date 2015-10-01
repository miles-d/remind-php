<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Acme\ReviewHelper;

class ReviewItem extends Model
{
    // Set custom table name
	protected $table = 'review_items';

	protected $fillable = [
		'user_id', 'description', 'comment', 'link', 'last_review_date', 'next_review_date', 'level', 'mastered',
	];

    // Get all topics of an user
	public static function getReviewItems(User $user)
	{
		$reviewItems = self::where('user_id', $user->id)
			->orderBy('next_review_date', 'asc')->get();

		return $reviewItems;
	}

    /**
     * Mark topic as reviewed
     *
     * Sets new level and schedules next review (unless topic is mastered)
     */
	public function review()
	{
		$this->level += 1;
		$newLevel = $this->level;
		$next_date = ReviewHelper::getNextReviewDate($newLevel);
		$this->next_review_date = $next_date;
		$today = new \DateTime;
		$this->last_review_date = $today->format('Y-m-d');
		$this->save();
	}

    /**
     * Reset topic progress
     *
     * Set level to 0, schedule next review for tomorrow
     */
	public function reset()
	{
		$this->level = 0;
		$next_date = ReviewHelper::getNextReviewDate(0);
		$this->next_review_date = $next_date;
		$this->save();
	}

    /**
     * Check if topic should be reviewed by now
     *
     */
	public function isDue()
	{
		$today = new \DateTime;

		return ($this->next_review_date <= $today->format('Y-m-d'));
	}
}

