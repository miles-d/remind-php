<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review\ReviewHelper;
use App\ReviewItem;
use Auth;

class ReviewDataController extends Controller
{
    public function index()
    {
        $reviewItems = Auth::user()->reviewItems()
            ->orderBy('mastered', 'asc')
            ->orderBy('next_review_date', 'asc')
            ->get();
        $reviewItems = $reviewItems->map(function ($item) {
            $item->is_due = $item->isDue();
            $item->schedule_type = $item->scheduleType();
            $item->next_review_date = ReviewHelper::readableDate($item->next_review_date);
            return $item;
        });
        return response()->json(['data' => $reviewItems]);
    }

    public function markReviewed($id)
    {
        $review = ReviewItem::find($id);
        $review->review()->save();
        return ['status' => 'success'];
    }
}
