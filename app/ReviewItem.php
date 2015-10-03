<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Acme\ReviewHelper;

class ReviewItem extends Model
{
    // Set custom table name
	protected $table = 'review_items';

	protected $fillable = [
        'user_id',
        'description',
        'comment',
        'link',
        'last_review_date',
        'next_review_date',
        'level',
        'mastered',
	];

    public static $reviewSteps = ['1 day', '1 week', '1 month', '3 months', '6 months', '1 year'];

    public function getNextReviewDate()
    {
        $date = new \DateTime(self::$reviewSteps[$this->level+1]);
        return $date->format('Y-m-d');
    }

    /**
     * Mark topic as reviewed
     *
     * Sets new level and schedules next review (unless topic is mastered)
     */
	public function review()
	{
		$this->level += 1;
        $this->next_review_date = $this->getNextReviewDate();
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
		$next_date = self::getNextReviewDate(0);
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

