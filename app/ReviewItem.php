<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review\ReviewHelper;

class ReviewItem extends Model
{
    protected $table = 'review_items';
    protected $guarded = [];

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

    public static $reviewSteps = [
        0 => '1 day',
        1 => '1 week',
        2 => '1 month',
        3 => '3 months',
        4 => '6 months',
        5 => '1 year'
    ]; 

    public function getNextReviewDate()
    {
        $date = new \DateTime(self::$reviewSteps[$this->level]);
        return $date->format('Y-m-d');
    }

    public function review()
    {
        $this->level += 1;

        if ($this->level >= 6) {
            $this->mastered = true;
            $this->next_review_date = '';
        } else {
            $this->next_review_date = $this->getNextReviewDate();
        }

        $today = new \DateTime;
        $this->last_review_date = $today->format('Y-m-d');
        $this->save();
    }

    public function reset()
    {
        $this->level = 0;
        $next_date = self::getNextReviewDate(0);
        $this->next_review_date = $next_date;
        $this->save();
    }

    public function isDue()
    {
        $today = new \DateTime;
        return ($this->next_review_date <= $today->format('Y-m-d'));
    }
}
