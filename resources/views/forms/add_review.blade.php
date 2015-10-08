{!! Form::open(['route' => ['review.store'], 'method' => 'POST']) !!}
<div class="form-group">
  {!! Form::label('description', 'Description: ') !!}
  {!! Form::text('description', null, ['required', 'autofocus', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('comment', '(optional) Comment:', ['class' => 'control-label']) !!}
  {!! Form::text('comment', null, ['autofocus', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
  {!! Form::label('link', '(optional) Link to material: (must start with "http://" or "https://")', ['class' => 'control-label']) !!}
  {!! Form::url('link', null, ['autofocus', 'class' => 'form-control', 'placeholder' => 'https://', 'pattern' => 'https?://.+']) !!}
</div>
  {!! Form::submit('Add!', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}
