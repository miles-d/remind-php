@extends('master')
@section('content')

<div class="page-header">
  <h1>Topics to review</h1>
</div>

<a id='add-new-topic' class="btn btn-primary btn-block" href="{{ route('review.create') }}">Add new topic</a>

<div class="table-responsive">
  <table class="table table-hover">
    <thead>
	<tr>
     <th>Description</th>
     <th>Next Review</th>
	</tr>
    </thead>
    <tbody>
    @foreach($review_items as $review)
	  @if($review->isDue())
	  <tr class="success">
	  @else
	  <tr>
	  @endif
		<td>
		  <a class="to-review" href="{{ route('review.show', [$review->id]) }}">{{ $review->description }}</a>
          @if(!empty($review->link))
          &nbsp;<a class="to-material" href="{{ $review->link }}"><small>(LINK)</small></a>
          @endif
		</td>
		<td>
		  {{ App\Acme\ReviewHelper::readableDate($review->next_review_date) }}
	    </td>
	    <td>
          @if ($review->mastered == '0' && $review->isDue())
			  @include('forms.reviewed-small')
		  @endif
		</td>
      </tr>
	@endforeach
    </tbody>
  </table>
</div>
@stop
