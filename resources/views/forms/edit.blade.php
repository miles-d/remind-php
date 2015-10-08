{!! Form::open(['method' => 'PATCH', 'route' => ['review.update', $review->id]]) !!}
<div class="form-group">
  {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
  {!! Form::text('description', $review->description, ['required', 'autofocus', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('comment', '(optional) Comment:', ['class' => 'control-label']) !!}
  {!! Form::text('comment', $review->comment, ['autofocus', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('link', '(optional) Link to material: (must start with "http://" or "https://")', ['class' => 'control-label']) !!}
  {!! Form::url('link', $review->link, ['autofocus', 'class' => 'form-control', 'placeholder' => 'https://', 'pattern' => 'https?://.+']) !!}
</div>
  {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}
