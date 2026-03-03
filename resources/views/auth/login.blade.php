<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>Admin</b>LTE</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    {{-- Alert error --}}
    <div id="alert-error" class="alert alert-danger" style="display:none;">
      <span id="alert-message"></span>
    </div>

    <form id="form-login">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">
            Sign In
          </button>
        </div>
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
    </div>

    <a href="{{ url('/password/request') }}">I forgot my password</a><br>
    <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>
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

    $('#form-login').on('submit', function (e) {
      e.preventDefault();

      var btn = $('#btn-login');
      btn.prop('disabled', true).text('Loading...');
      $('#alert-error').hide();

      $.ajax({
        url: '{{ url("/auth/login") }}',
        method: 'POST',
        data: {
          _token:   '{{ csrf_token() }}',
          email:    $('#email').val(),
          password: $('#password').val(),
        },
        success: function (res) {
          window.location.href = '{{ url("/dashboard") }}';
        },
        error: function (xhr) {
          var msg = 'Terjadi kesalahan, coba lagi.';

          if (xhr.status === 401) {
            msg = xhr.responseJSON.message;
          } else if (xhr.status === 422) {
            var errors = xhr.responseJSON.errors;
            msg = Object.values(errors).flat().join('<br>');
          }

          $('#alert-message').html(msg);
          $('#alert-error').show();
          btn.prop('disabled', false).text('Sign In');
        }
      });
    });
  });
</script>
</body>
</html>