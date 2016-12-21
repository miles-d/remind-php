<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ReviewItem;
use App\Review\ReviewHelper;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $review_items = Auth::user()->reviewItems()->orderBy('next_review_date', 'asc')->get();
        return view('review.home', compact('review_items'));
    }

    public function create()
    {
        return view('review.create');
    }

    public function store(Request $request, ReviewItem $review)
    {
        $input['_token']      = $request->_token;
        $input['description'] = $request->description;
        $input['comment']     = $request->comment;
        $input['link']        = $request->link;
        $input['user_id']     = Auth::user()->id;

        $today = new \DateTime('tomorrow');
        $input['next_review_date'] = $today->format('Y-m-d');

        $review->create($input);

        return redirect()->route('review.index')
            ->with('status', 'success')
            ->with('msg', 'New topic added!');
    }

    public function show($id)
    {
        $review = ReviewItem::find($id);
        return view('review.show', compact('review'));
    }

    public function edit($id)
    {
        $review = ReviewItem::find($id);
        return view('review.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = ReviewItem::find($id);
        $review->description = $request['description'];
        $review->comment = $request['comment'];
        $review->link = $request['link'];
        $review->save();

        return redirect()->route('review.index')
            ->with('status', 'success')
            ->with('msg', 'Saved!');
    }

    public function destroy($id)
    {
        $review = ReviewItem::find($id);
        $review->delete();

        return redirect()->route('review.index')
            ->with('status', 'success')
            ->with('msg', 'Topic deleted');
    }

    public function markReviewed($id)
    {
        $review = ReviewItem::find($id);
        $review->review()->save();

        return redirect()->route('review.index')
            ->with('status', 'success')
            ->with('msg', 'Topic reviewed - awesome!');
    }

    public function delete($id)
    {
        $review = ReviewItem::find($id);
        return view('review.delete', compact('review'));
    }

    public function reset($id)
    {
        $review = ReviewItem::find($id);
        $review->reset();
        return redirect()->route('review.index')
            ->with('status', 'success')
            ->with('msg', 'Topic reset successfully');
    }
}
