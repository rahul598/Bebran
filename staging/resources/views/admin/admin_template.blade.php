@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ __('Dashboard') }} <small>Control panel</small></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      
      <?php /*<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{!!count(get_fields_value_where('pages',"posttype='page'",'menu_order','asc'))!!}<!-- <sup style="font-size: 20px">%</sup> --></h3>

            <p>Pages</p>
          </div>
          <a href="{{ url('/page/add') }}"><div class="icon">
            <i class="ion ion-plus"></i>
          </div></a>
          <a href="{{ url('/page') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>*/?>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $customers }}</h3>

            <p>User</p>
          </div>
          <a href="{{ url('/user/add') }}"><div class="icon">
            <i class="ion ion-plus"></i>
          </div></a>
          <a href="{{ url('/user') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <?php /*<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $admin }}</h3>

            <p>Admin</p>
          </div>
          <a href="{{ url('/user/add') }}"><div class="icon">
            <i class="ion ion-plus"></i>
          </div></a>
          <a href="{{ url('/user') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ count(get_fields_value_where('pages',"posttype='country'",'menu_order','asc')) }}</h3>

            <p>Country Pages</p>
          </div>
          <a href="{{ url('/countrypage/add') }}"><div class="icon">
            <i class="ion ion-plus"></i>
          </div></a>
          <a href="{{ url('/countrypage') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>*/?>
      <!-- ./col -->
    </div>
    <!-- /.row -->

  </div>
</section>
<!-- /.content -->
@endsection

@section('more-scripts')
@stop

