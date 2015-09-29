@extends('master')

@section('content')

	<div class="page-header">
	  <h1>Confirm deletion</h1>
	</div>

	@include('forms.destroy')

<a class="btn btn-default btn-block" href="{{ route('review.show', [$review->id]) }}">Back</a>

@stop
