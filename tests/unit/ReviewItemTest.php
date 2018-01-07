<?php
namespace Test\Unit\ReviewItem;

use PHPUnit\Framework\TestCase;
use App\ReviewItem;
use DateTime;
use DateInterval;

class ReviewItemTest extends TestCase
{
    public function testReview()
    {
        $item = new ReviewItem;
        $item->level = 0;
        $item->review();
        $this->assertSame(1, $item->level);
    }

    public function testDoesNotLevelAboveLastLevel()
    {
        $item = new ReviewItem;
        $item->level = $item->lastLevel() - 1;
        $item->review();
        $this->assertSame($item->lastLevel(), $item->level);
        $item->review();
        $this->assertSame($item->lastLevel(), $item->level);
    }

    public function testIsNotDueIfMastered()
    {
        $item = new ReviewItem;
        $item->level = $item->lastLevel();
        $yesterday = (new DateTime)->sub(new DateInterval("P1D"))->format('Y-m-d');
        $item->next_review_date = $yesterday;
        $this->assertFalse($item->isDue());
    }

    public function testLevelLimit()
    {
        $item = new ReviewItem;
        $this->assertNull($item->mastered);
        $item->level = 5;
        $item->review();
        $this->assertTrue($item->mastered);
    }

    public function testStandardScheduleFirstStep()
    {
        $item = new ReviewItem;
        $item->level = 0;
        $tomorrow = (new DateTime('tomorrow'))->format('Y-m-d');
        $this->assertSame($tomorrow, $item->getNextReviewDate());
        $this->assertSame(0, $item->level);

        $item->review();
        $nextWeek = (new DateTime())->add(new DateInterval('P7D'))->format('Y-m-d');
        $this->assertSame($nextWeek, $item->getNextReviewDate());
        $this->assertSame(1, $item->level);
    }

    public function testMonthlySchedule()
    {
        $item = new ReviewItem;
        $item->setMonthlySchedule();
        $item->level = 0;

        $item->review();

        $nextMonth = (new DateTime)->add(new DateInterval("P1M"))->format('Y-m-d');
        $this->assertSame($nextMonth, $item->getNextReviewDate());
        $this->assertSame(1, $item->level);

        $item->review();

        $nextMonth = (new DateTime)->add(new DateInterval("P1M"))->format('Y-m-d');
        $this->assertSame($nextMonth, $item->getNextReviewDate());
        $this->assertSame(2, $item->level);
    }
}
