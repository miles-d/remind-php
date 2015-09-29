{!! Form::open(['route' => ['review.store'], 'method' => 'POST']) !!}
<div class="form-group">
	{!! Form::label('description', 'Description: ') !!}
	{!! Form::text('description', null, ['required', 'autofocus', 'class' => 'form-control']) !!}
</div>
    {!! Form::submit('Add!', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}
