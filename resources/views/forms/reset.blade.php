{!! Form::open(['method' => 'PATCH', 'route' => ['review.reset', $review], 'class' => 'form-inline']) !!}
  {!! Form::submit('Reset', ['class' => 'btn btn-warning btn-block']) !!}
{!! Form::close() !!}
