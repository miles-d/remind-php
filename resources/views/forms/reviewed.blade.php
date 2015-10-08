{!! Form::open(['method' => 'PATCH', 'route' => ['review.markReviewed', $review], 'class' => 'form-inline']) !!}
  {!! Form::submit('Mark reviewed', ['class' => 'btn btn-success btn-block']) !!}
{!! Form::close() !!}
