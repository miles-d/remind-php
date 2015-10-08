@extends('master')
@section('content')
<div class="page-header">
  <h1>Edit topic</h1>
</div>
@include('forms.edit')
<a href="{{ route('review.show', [$review->id]) }}" class="btn btn-default btn-block">Back</a>
@stop
