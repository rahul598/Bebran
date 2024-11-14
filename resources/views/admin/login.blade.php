<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | {{config('site.title')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_lte/custom.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{url('/')}}" class="h1">
          @if( config('site.logo')!='' && File::exists(public_path('uploads/'.config('site.logo'))) )
            <img src="{{ asset('/uploads/'.config('site.logo')) }}" class="user-image" alt="User Image" style="width: 100%;">
          @else
            <p>H<b>ome</b></p>
          @endif
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <!-- if there are login errors, show them here -->
        @if($errors->has('email') || $errors->has('password') || $errors->has('authentication') || $errors->has('errormsg'))   
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          {{ $errors->first('email') }}
          {{ $errors->first('password') }}
          {{ $errors->first('authentication') }}
          {{ $errors->first('errormsg') }}
        </div>
        @endif
        <form type="form" action="{{ url('/admin/login') }}"  method="post" enctype="multipart/form-data" class="customValidate">
          @csrf
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" />
            <!-- @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror -->
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            <span class="focus-input100"></span>
            <!-- <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
            </span> -->
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">

              <button type="submit" class="btn btn-primary btn-block">
                {{ __('Login') }}
              </button>
              <!--<button type="submit" class="btn btn-primary btn-block">Sign In</button> -->
            </div>
          <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
        </div> -->
        <!-- /.social-auth-links -->

        <!--<p class="mb-1">-->
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">I forgot my password?</a>
        @endif
        <!--</p>-->
        <!-- <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
      </div>
    <!-- /.card-body -->
    </div>
  <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin_lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin_lte/dist/js/adminlte.js') }}"></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js'></script>
  <script>
  $(function () {
    jQuery(".customValidate").validate();
    jQuery(".customValidate2").validate();
  });
  </script>
</body>
</html>
