<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} | Registration Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ url('/') }}"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ url('/register') }}" method="post">
      @csrf

      <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
        <input type="text" name="name" class="form-control" placeholder="Full name" value="{{ old('name') }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('name')
          <span class="help-block">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
          <span class="help-block">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
          <span class="help-block">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        @error('password_confirmation')
          <span class="help-block">{{ $message }}</span>
        @enderror
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="agree"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-facebook"></i> Sign up using Facebook
      </a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat">
        <i class="fa fa-google-plus"></i> Sign up using Google+
      </a>
    </div>

    <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
  </div>
</div>

<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>