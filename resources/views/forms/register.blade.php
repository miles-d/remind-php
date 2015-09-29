{!! Form::open(['route' => ['auth.register'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
  <fieldset>

    <div class="form-group">
  	<label for="name" class="col-lg-2 control-label">Name</label>
  	<div class="col-lg-10">
  		<input class="form-control" type="name" name="name" value="{{ old('name') }}" required autofocus>
  	</div>
    </div>

    <div class="form-group">
  	<label for="email" class="col-lg-2 control-label">E-mail</label>
  	<div class="col-lg-10">
  	  <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
  	</div>
    </div>

    <div class="form-group">
  	<label for="password" class="col-lg-2 control-label">Password</label>
  	<div class="col-lg-10">
  	  <input class="form-control" type="password" name="password" required>
  	</div>
    </div>

    <div class="form-group">
  	<label for="password_confirmation" class="col-lg-2 control-label">Repeat Password</label>
  	<div class="col-lg-10">
  	  <input class="form-control" type="password" name="password_confirmation" required>
  	</div>
    </div>

    <div class="form-group">
  	<div class="col-lg-10 col-lg-offset-2">
  	  <button type="submit" class="btn btn-primary btn-block">Create Account</button>
  	</div>
    </div>

  </fieldset>
{!! Form::close() !!}
