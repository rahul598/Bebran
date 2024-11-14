<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
    @if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))))
    <link rel="apple-touch-icon" href="{!! ( config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) ) ? asset('/uploads/'.config('site.favicon')) : '' !!}" type="image/x-icon">
    @endif
    @if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))))
    <link rel="icon" href="{!! ( config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) ) ? asset('/uploads/'.config('site.favicon')) : '' !!}" type="image/x-icon" sizes="32x32">
    @endif
    @if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))))
    <link rel="icon" href="{!! ( config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) ) ? asset('/uploads/'.config('site.favicon')) : '' !!}" type="image/x-icon" sizes="192x192">
    @endif
  <link rel="stylesheet" href="{{ asset('frontend/user_assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
   <!-- Sidebar Start -->
   @include('frontend.user-dashboard.inc.sidebar')
   <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('frontend.user-dashboard.inc.header')
      <!--  Header End -->
     @yield('content')
    </div>
  </div>
  <script src="{{ asset('frontend/user_assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('frontend/user_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('frontend/user_assets/js/sidebarmenu.js')}}"></script>
  <script src="{{ asset('frontend/user_assets/js/app.min.js')}}"></script>
  <script src="{{ asset('frontend/user_assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{ asset('frontend/user_assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{ asset('frontend/user_assets/js/dashboard.js')}}"></script>
</body>

</html>