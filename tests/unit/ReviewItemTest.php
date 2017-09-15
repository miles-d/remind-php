<?php
namespace Test\Unit\ReviewItem;

use PHPUnit\Framework\TestCase;
use App\ReviewItem;

class ReviewItemTest extends TestCase
{
    public function testReview()
    {
        $item = new ReviewItem;
        $item->level = 0;
        $item->review();
        $this->assertEquals(1, $item->level);
    }

    public function testDoesNotLevelAboveLastLevel()
    {
        $item = new ReviewItem;
        $item->level = ReviewItem::lastLevel() - 1;
        $item->review();
        $this->assertEquals(ReviewItem::lastLevel(), $item->level);
        $item->review();
        $this->assertEquals(ReviewItem::lastLevel(), $item->level);
    }

    public function testIsNotDueIfMastered()
    {
        $item = new ReviewItem;
        $item->level = ReviewItem::lastLevel();
        $yesterday = (new \DateTime)->sub(new \DateInterval("P1D"))->format('Y-m-d');
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
}
