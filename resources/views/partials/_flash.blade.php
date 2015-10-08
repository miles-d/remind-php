@if(Session::has('errors'))
<div id="flash" class="alert alert-warning navbar-fixed-top">
  <h4>{{ $errors->all()[0] }}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
  </h4>
</div>
@elseif(Session::has('msg'))
<div id="flash" class="alert alert-{{ Session::get('status') }} navbar-fixed-top">
  <h4>{{ Session::get('msg') }}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
  </h4>
</div>
@endif

