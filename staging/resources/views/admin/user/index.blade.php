@extends('layouts.admin')

@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
$payment_status_array = unserialize(Payment_Status_Array);
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ (Request::is('user/customer') ? 'Customer':__('Admin')) }} <!--<button type="button" class="btn btn-primary" onclick="window.location.href='{{ url(Admin_Prefix.'user/export') }}'" title="Export Active User">Export</button>--></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{(Request::is('user/customer') ? 'Customer':__('Admin'))}}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-12">
      <div class="card">
       <div class="card-header">
          <h3 class="card-title">Listing</h3>
          <div class="card-tools listing_page">
          <form action="">
            <div class="input-group input-group-sm" style="/*width: 150px;*/">

              <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ $search }}">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>

            </div>
          </form>
        </div>

      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">

        <table id="example1" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
              @foreach($column_array as $key => $value)
              <th>
                <a href="{{ $sorting_array[$key]['sorting_url'] }}" class="{{ $sorting_array[$key]['sorting_class'] }}">{{$value}}</a>
              </th>
              @endforeach
              <th>
                Action
              </th>
            </tr>
          </thead>
          <tbody>

          @if ($users->count() > 0)
           @foreach($users as $user)

           <tr>
            @foreach($column_array as $key => $value)
              
              @if ($key=='fname')
                <td>{!! $user->$key.' '.$user->lname !!}</td>
              @elseif ($key=='created_at')              
                <td>{!! date_convert($user->$key,3) !!}</td>
              @elseif ($key=='status')              
                <td><span class="badge bg-{{$user->$key==1?'success':'danger'}}">{!! $user_status_array[$user->$key] !!}</span></td>
              @elseif($key=='last_login')
                <td>{!! date_convert($user->$key, 4) !!}</td>
              @else
                <td>{{ $user->$key }}</td>
              @endif

              
            @endforeach

            <td>
              <a href="{{ url(Admin_Prefix.'user/edit/'.$user->id) }}" title="Edit" class="btn btn-success"><i class="fa fa-fw fa-edit"></i></a>
              @if( $user->role_id=='2')
              <a href="{{ url(Admin_Prefix.'user/view/'.$user->id) }}" title="View" class="btn btn-info"><i class="fa fa-fw fa-eye"></i></a>
              @endif
              @if( $user->id>1)
              <a href="{{ url(Admin_Prefix.'user/delete/'.$user->id) }}" data-confirm="" title="Delete" class="btn btn-danger"><i class="fa fa-window-close"></i></a>
              @endif
            </td>

          </tr>
          @endforeach

          @else

          <tr>
            <td colspan="<?php echo count($column_array)+1;?>" align="middle">No Data Found</td>
          </tr>

          @endif
        </tbody>

      </table>

      {{$users->appends(request()->input())->links("pagination::bootstrap-4")}}

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
</section>
<!-- /.content --> 
@endsection


@section('more-scripts')

<script type="text/javascript">


</script>

@stop

