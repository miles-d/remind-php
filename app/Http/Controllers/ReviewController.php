<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ReviewItem;
use App\Acme\ReviewHelper;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		// get user's review items, sorted
        $review_items = Auth::user()->reviewItems()->orderBy('next_review_date', 'asc')->get();

		return view('review.home', compact('review_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		return view('review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, ReviewItem $review)
    {
		$input['_token'] = $request->_token;
		$input['description'] = $request->description;
		$input['comment'] = $request->comment;
		$input['link'] = $request->link;
		$input['user_id'] = Auth::user()->id;
		$today = new \DateTime('tomorrow');
		$input['next_review_date'] = $today->format('Y-m-d');
		
		$review->create($input);

		return redirect()->route('review.index')
			->with('status', 'success')
			->with('msg', 'New topic added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(ReviewItem $review)
    {
		return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(ReviewItem $review)
    {
		return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, ReviewItem $review)
    {
		$review->description = $request['description'];
		$review->comment = $request['comment'];
		$review->link = $request['link'];
		$review->save();

		return redirect()->route('review.index')
			->with('status', 'success')
			->with('msg', 'Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(ReviewItem $review)
    {
		$review->delete();

		return redirect()->route('review.index')
			->with('status', 'success')
			->with('msg', 'Topic deleted');
    }

	/**
	 * Mark a review item as reviewed (level it up)
	 *
	 */
	public function markReviewed(ReviewItem $review)
	{
		$review->review();

		return redirect()->route('review.index')
			->with('status', 'success')
			->with('msg', 'Topic reviewed - awesome!');
	}

	/**
	 * Show confirmation for review deletion
	 *
	 */
	public function delete(ReviewItem $review)
	{
		return view('review.delete', compact('review'));
	}

	public function reset(ReviewItem $review)
	{
		$review->reset();

		return redirect()->route('review.index')
			->with('status', 'success')
			->with('msg', 'Topic reset successfully');
	}
}
