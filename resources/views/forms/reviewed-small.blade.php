{!! Form::open(['method' => 'PATCH', 'route' => ['review.markReviewed', $review], 'class' => 'form-inline']) !!}
  <button type="submit" class="btn btn-xs btn-success"><span class="hidden-xs">Mark</span> reviewed</button>
{!! Form::close() !!}
