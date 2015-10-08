@extends('master')
@section('content')
<div class="page-header">
  <h1>Log In</h1>
</div>
<div>
  <div class="row">
    <div class="col-lg-3" id="about">
      <h4><b>Remind</b> is a tool that helps you organize reviewing your learning material.</h4>
      <h4>Just give it the names of topics, books, or anything else - <b>Remind</b> will
      tell you when is the best time to review.</h4>
    </div>
    <div class="col-lg-6 col-lg-offset-1">
      <div class="well">
        @include('forms.login')
        <h2 class="help-block text-right">First time here?</h2>
        <a href="{!! route('auth.showRegister') !!}"><h2 class="text-right">Create an account!</h2></a>
      </div>
    </div>
  </div>
</div>
@stop
