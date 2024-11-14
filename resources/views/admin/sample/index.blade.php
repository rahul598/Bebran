@extends('layouts.admin')

@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Sample') }} <a href="{{ url(Admin_Prefix.'sample/add') }}" class="btn btn-primary">Add</a></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Sample') }}</li>
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
                <div class="input-group input-group-sm" style="">

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

        <table id="example2" class="table table-bordered table-hover dataTable">
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

          @if ($lists->count() > 0)
           @foreach($lists as $list)
           <tr>
            @foreach($column_array as $key => $value)

              @if ($key=='created_at')              
                <td>{!! date_convert($list->$key,3) !!}</td>
              @elseif ($key=='category_id')        
                <td>{!! !empty($list->category->name) ? $list->category->name : '' !!}</td>  
              @elseif ($key=='status')              
                <td><span class="badge bg-{{$list->$key==1?'success':($list->$key==2?'danger':'warning')}}">{!! @$user_status_array[$list->$key] !!}</span></td>
              @else
                <td>{{ $list->$key }}</td>
              @endif

            @endforeach

            <td>
              <a href="{{ url(Admin_Prefix.'sample/edit/'.$list->id) }}" title="Edit" class="btn btn-success"><i class="fa fa-fw fa-edit"></i></a>
              <a href="{{ url(Admin_Prefix.'sample/status/'.$list->id.'/'.$list->status) }}" title="Status" class="btn {{$list->status!=1?'btn-warning':'btn-info'}}"><i class="fa fa-fw fa-lightbulb {{$list->status!=1?'inactive':''}}"></i></a>
              <!-- <a href="{{ url(Category_Prefix.$list->slug) }}" title="View" target="_blank" class="btn btn-info"><i class="fa fa-fw fa-eye"></i></a> -->
              <a href="{{ url(Admin_Prefix.'sample/delete/'.$list->id) }}" data-confirm="" title="Delete" class="btn btn-danger"><i class="fa fa-fw fa-window-close"></i></a>
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

            {{$lists->appends(request()->input())->links("pagination::bootstrap-4")}}
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
