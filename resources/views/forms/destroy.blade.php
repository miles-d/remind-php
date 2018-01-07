{!! Form::open(['method' => 'DELETE', 'route' => ['review.destroy', $review->id], 'class' => 'form-horizontal', 'id' => 'delete-review-form']) !!}
  <button id="confirm-delete-review-button" class="btn btn-danger btn-block" role="submit">Yes, delete it</button>
{!! Form::close() !!}
