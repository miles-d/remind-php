@extends('master')

@section('title')
Create Topic
@endsection

@section('content')
<div class="page-header">
  <h1>Add new topic to review</h1>
</div>
@include('forms.add_review')
<a class="btn btn-default btn-block" href="{{ route('review.index') }}">Back</a>
@stop
