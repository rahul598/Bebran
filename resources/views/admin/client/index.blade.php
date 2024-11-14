@extends('layouts.admin')
@section('more-css')
<style>
    .dataTables_filter{
        display:none;
    }
</style>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.2em 1em;
        margin-left: 2px;
        display: inline-block;
        cursor: pointer;
        color: #333333 !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: white !important;
        border:none !important;
        background: #007bff !important;
    }
    
</style>
@endsection
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ __('Price Widget Features List') }} </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('Price Widget Features List') }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listing</h3>
            <div class="card-tools listing_page">
               
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
        <table id="example2" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
                <th>Id</th>
                <th>Name</th> 
                <th>Email</th> 
                <th>Phone</th> 
                <th>Action</th> 
            </tr>
          </thead>
          <tbody>
               @php $row = 1 @endphp
               @if($client_data)
              @foreach($client_data as $key => $val) 
           <tr>
                <td>{{ $row++ }}</td>
                <td>{{  $val['first_name'] }} {{$val['last_name']}}</td> 
                <td>{{  $val['email'] }} </td> 
                <td>{{  $val['phone'] }}  </td> 
                <td>
                    <a href="{{route('view_client_data',$val['id'])}}" title="View" class="btn btn-success"><i class="fa fa-fw fa-eye"></i></a>
                    <a href=" " data-confirm="" title="Delete" class="btn btn-danger"><i class="fa fa-fw fa-window-close"></i></a> 
                     
                </td> 
            </tr> 
            @endforeach
            @endif
        </tbody>
      </table>
 
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
<script>
    
    $(document).ready(function(){
         $('.dataTable').dataTable({
             searching: false
         });
    });
</script>
@endsection
