{!! Form::open(['method' => 'POST', 'route' => ['review.markReviewed', $review], 'class' => 'form-inline']) !!}
  {!! Form::submit('Mark reviewed', ['class' => 'btn btn-success btn-block', 'id' => 'mark-reviewed-btn']) !!}
  <input type="hidden" id="review_item_id" name="review_item_id" value="{{ $review->id }}">
{!! Form::close() !!}
