@extends('master')
@section('content')
<div class="page-header">
  <h1>Create Account</h1>
</div>
<div>
  <div class="row">
    <div class="col-lg-6">
      <div class="well">
      @include('forms.register')
      </div>
    </div>
    <div class="col-lg-4 col-lg-offset-1">
        <h2 class="help-block">Already have an account?</h2>
        <a href="{!! route('auth.showLogin') !!}"><h2>Log In!</h2></a>
    </div>
  </div>
</div>
@stop
