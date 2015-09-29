{!! Form::open(['method' => 'PATCH', 'route' => ['review.markReviewed', $review], 'class' => 'form-inline']) !!}
	{!! Form::submit('Mark reviewed', ['class' => 'btn btn-xs btn-success']) !!}
{!! Form::close() !!}
