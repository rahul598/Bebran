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
          <h1 class="m-0 text-dark">{{ __('Case Studies Landing') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Case Studies Landing') }}</li>
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

                @if ($pages->count() > 0)
                @foreach($pages as $page)

                <tr>
                  @foreach($column_array as $key => $value)

              @if ($key=='created_at')              
                <td>{!! date_convert($page->$key,3) !!}</td>
              @elseif ($key=='parent_id')              
                <td>{!! $page->$key>0?get_field_value('pages','page_name','id',$page->$key):'Top' !!}</td>
              @elseif ($key=='status')              
                <td><span class="badge bg-{{$page->$key==1?'success':($page->$key==2?'danger':'warning')}}">{!! @$user_status_array[$page->$key] !!}</span></td>
              @else
                  <td>{{ $page->$key }}</td>
              @endif
                  @endforeach
                  <td width="170">
                    <a href="{{ url(Admin_Prefix.'page/edit/'.$page->id) }}" title="Edit" class="btn btn-success"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="{{ url($page->slug) }}" title="View" target="_blank" class="btn btn-info"><i class="fa fa-fw fa-eye"></i></a>
                    @if(!in_array($page->id, Not_Deletable_Page_ID))
                    <a href="{{ url(Admin_Prefix.'page/delete/'.$page->id) }}" class="btn btn-danger" data-confirm="" title="Delete"><i class="fa fa-window-close"></i></a>
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
            {{$pages->appends(request()->input())->links("pagination::bootstrap-4")}}
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
