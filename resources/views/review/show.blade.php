@extends('master')

@section('title')
Topic Summary
@endsection

@section('content')
<div class="page-header">
  <h1>Topic Summary</h1>
</div>

<h2 class="underline">Description:</h2>
<div class="well">
  <p>{{ $review->description }}</p>
</div>

<h2 class="underline">Comment:</h2>
<div class="well">
  <p>
      @if( empty($review->comment) )
        (No comment. Click 'Edit' below to add.)
      @else
        {{ $review->comment }}
      @endif
      </p>
    </div>

    <h2 class="underline">Link to material:</h2>
    <div class="well">
      <p>
      @if( empty($review->link) )
        (No link. Click 'Edit' below to add.)
      @else
      <a class="to-material" href="{{ $review->link }}">{{ $review->link }}</a>
      @endif
      </p>
    </div>

    <h2 class="underline">Last Review:</h2>
    <div class="well">
      @if($review->last_review_date)
      <p>{{ App\Review\ReviewHelper::readableDate($review->last_review_date) }} ({{ $review->last_review_date }})</p>
      @else
      <p>No review yet!</p>
      @endif
    </div>

    <h2 class="underline">Next Review:</h2>
    <div class="well">
      <p>
        {{ App\Review\ReviewHelper::readableDate($review->next_review_date) }}
        @if ($review->next_review_date)
          ({{ $review->next_review_date }})
        @endif
      </p>
    </div>

    <h2 class="underline">Level:</h2>
    <div class="well">
      <p>{{ $review->level }}</p>
    </div>

    <h2 class="underline">Creation date:</h2>
    <div class="well">
      <p>{{ App\Review\ReviewHelper::readableDate($review->created_at->format('Y-m-d')) }} ({{ $review->created_at->format('Y-m-d') }})</p>
    </div>

    <h2 class="underline">Schedule Type:</h2>
    <div class="well">
<p>{{ ucfirst($review->scheduleType()) }}</p>
    </div>

    @if ($review->mastered == '0' && $review->isDue())
        @include('forms.reviewed')
    @endif

    <a id="edit-review-button" class="btn btn-default btn-block" href="{{ route('review.edit', [$review]) }}">Edit</a>

    @include('forms.reset')

    <a id="delete-review-button" class="btn btn-danger btn-block" href="{{ route('review.delete', [$review]) }}">Delete</a>
    <a id="back-button" class="btn btn-default btn-block" href="{{ route('review.index') }}">Back</a>
@stop
