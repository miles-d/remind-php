{!! Form::open(['route' => ['auth.login'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
<fieldset>
  <div class="form-group">
    <label for="email" class="col-lg-2 control-label">E-mail</label>
    <div class="col-lg-10">
      <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-lg-2 control-label">Password</label>
    <div class="col-lg-10">
      <input class="form-control" type="password" name="password" required>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="remember"  checked> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
      <button type="submit" class="btn btn-primary btn-block">Log In</button>
    </div>
  </div>
</fieldset>
{!! Form::close() !!}
