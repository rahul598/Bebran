<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Verify Email | {{config('site.title')}}</title>
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
        <h2 class="login-box-msg">Verify Your Email Address!</h2>
            <p>Before proceeding, please check your email for a verification link.</p>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
            {{ __('If you did not receive the email') }},
            <form class="text-center" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>.
            </form>
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


