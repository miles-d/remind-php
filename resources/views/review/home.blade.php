@extends('master')
@section('content')
<div class="page-header">
  <h1>Topics to review</h1>
</div>
<a id='add-new-topic' class="btn btn-primary btn-block" href="{{ route('review.create') }}">Add new topic</a>
<div class="table-responsive">
  <table id="review-table" class="table table-hover">
    <thead>
	<tr>
     <th>Description</th>
     <th>Next Review</th>
	</tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@stop
