<!DOCTYPE html>
<html>
<head>
    <title>Remind</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/sandstone/bootstrap.min.css"> 
    <link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>
<div id="wrap">
  <div class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
  	    <a class="navbar-brand" href="{{ route('review.index') }}">Remind</a>
      </div>
      <div class="navbar-default" id="navbar-main">
        <ul class="navbar navbar-nav navbar-right">
  	      <ul class="nav navbar-nav navbar-right">
            @if(Auth::user())
	        <li><a href="{{ route('auth.logout') }}">Log Out {{ Auth::user()->email }}</a></li>
            @else
            <li><a href="{{ route('auth.register') }}">Create Account</a></li>
            <li><a href="{{ route('auth.login') }}">Log In</a></li>
            @endif
  	      </ul>
        </ul>
      </div>
    </div>
  </div>
  <div class="container">
	@include('partials._flash')
	@yield('content')
  </div>
  <div class="push"></div>
</div>
  <div class="footer">
  	<p class="text-center">
          © <a href="mailto:milosz.danczak@gmail.com">Milosz Danczak</a>
  	</p>
  </div>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
  <script src="/js/script.js"></script>
</body>
</html>
