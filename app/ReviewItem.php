<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review\ReviewHelper;
use DateTime;

class ReviewItem extends Model
{
    protected $table = 'review_items';
    protected $guarded = [];
    const MONTHLY = 'monthly';
    const STANDARD = 'standard';

    protected $fillable = [
        'user_id',
        'description',
        'comment',
        'link',
        'last_review_date',
        'next_review_date',
        'level',
        'mastered',
        'schedule_type',
    ];

    private function reviewSteps()
    {
        return [
            0 => '1 day',
            1 => '1 week',
            2 => '1 month',
            3 => '3 months',
            4 => '6 months',
            5 => '1 year'
        ];
    }

    public function lastLevel()
    {
        if ($this->isMonthly()) {
            return $this->level + 100;
        }
        return count($this->reviewSteps());
    }

    public function getNextReviewDate()
    {
        if ($this->isMonthly()) {
            $date = new DateTime('1 month');
        } else {
            $date = new DateTime($this->reviewSteps()[$this->level]);
        }
        return $date->format('Y-m-d');
    }

    public function review()
    {
        if ($this->isMonthly()) {
            $this->mastered = false;
        }

        if ($this->level < $this->lastLevel())
            $this->level += 1;

        if ($this->level >= $this->lastLevel()) {
            $this->mastered = true;
            $this->next_review_date = '';
        } else {
            $this->next_review_date = $this->getNextReviewDate();
        }

        $today = new DateTime;
        $this->last_review_date = $today->format('Y-m-d');
        return $this;
    }

    public function reset()
    {
        $this->level = 0;
        $next_date = $this->getNextReviewDate();
        $this->next_review_date = $next_date;
        $this->save();
    }

    public function isDue()
    {
        if ($this->level >= $this->lastLevel())
            return false;
        $today = new DateTime;
        return ($this->next_review_date <= $today->format('Y-m-d'));
    }

    public function setMonthlySchedule()
    {
        $this->schedule_type = self::MONTHLY;
    }

    private function isMonthly()
    {
        return $this->schedule_type == self::MONTHLY;
    }

    public function scheduleType()
    {
        return $this->schedule_type ?? self::STANDARD;
    }
}
