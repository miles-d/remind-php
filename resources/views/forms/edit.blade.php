{!! Form::open(['method' => 'PATCH', 'route' => ['review.update', $review->id], 'id' => 'edit-review-form']) !!}
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
<div class="form-group">
  {!! Form::label('schedule-type-select', 'Type of schedule', ['class' => 'control-label']) !!}
  {!! Form::select('schedule_type', ['standard' => 'Standard', 'monthly' => 'Monthly'], $review->scheduleType(), ['class' => 'form-control']) !!}
</div>
  {!! Form::submit('Save', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}
