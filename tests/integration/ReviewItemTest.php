<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ReviewItem;
use App\User;

class ReviewItemTest extends TestCase
{

    public function testCreateReviewItem()
    {
        $item = new ReviewItem;
        $user = User::all()->first();
        $item->user_id = $user->id;
        $item->description = 'myitem';
        $item->save();
        $this->seeInDatabase('review_items', [
            'description' => 'myitem',
            'user_id' => $user->id,
        ]);
        $item->delete();
    }

    public function testReview()
    {
        $item = new ReviewItem;
        $user = User::all()->first();
        $item->user_id = $user->id;
        $item->description = 'myitem';
        $item->save();

        $this->seeInDatabase('review_items', [
            'description' => 'myitem',
            'user_id' => $user->id,
            'level' => 0,
        ]);
        $item->review()
            ->save();

        $this->seeInDatabase('review_items', [
            'description' => 'myitem',
            'user_id' => $user->id,
            'level' => 1,
        ]);
        
        $item->delete();
    }
}
