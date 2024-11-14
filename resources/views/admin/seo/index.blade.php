@extends('layouts.admin')
<style>
.btn-light{
    background-color:#06D001 !important;
}
</style>
@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
@endphp
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Pages') }}</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
               <li class="breadcrumb-item active">{{ __('Pages') }}</li>
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
                              <button type="submit" class="btn btn-default h-100" ><i class="fa fa-search"></i></button>
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
                              <a href="{{ $sorting_array[$key]['sorting_url'] }}" class="{{ $sorting_array[$key]['sorting_class'] }} text-dark">{{$value}}</a>
                           </th>
                           @endforeach
                           <th>Display Ordetr</th>
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
                           @elseif ($key=='display_on_off')   
                            <td>
                               <span class="badge bg-{{$page->$key=='Active'?'success':'danger'}}">{{ $page->$key }}</span>
                            </td>
                           @else 
                           <td>
                              {{ $page->$key }}
                           </td>
                           @endif
                           
                           @endforeach
                           <td> 
                                <form class="form-inline" action="javascript:void(0);" method="post">
                                    <div class="form-group input-group-sm mx-sm-3 mb-2"> 
                                        <input type="number" class="form-control order_input_id" id="inputPassword2" value="{{$page->display_order}}" placeholder="Place Display Order" data-id="{{$page->id}}">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary mb-2 place_order">Add Order</button>
                                </form>
                            </td>
                           <td width="170">
                                <a href="{{ url(Admin_Prefix.'seo-landing/edit/'.$page->id) }}" title="Edit" class="p-1 btn btn-success"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="{{ url('seo-result/'.$page->slug) }}" title="View" target="_blank" class="p-1 btn btn-info"><i class="fa fa-fw fa-eye"></i></a>
                                <a href="{{  url(Admin_Prefix.'seo_result/status/'.$page->id) }}" title="Status" class="p-1 btn {{$page->display_on_off != 'Active'?'btn-warning':'btn-light'}}">
                                  <i class="fa fa-fw fa-lightbulb {{$page->display_on_off!= 'Active'?'Inactive':'text-white'}}"></i>
                                </a>
                              @if(!in_array($page->id, Not_Deletable_Page_ID))
                              <a href="{{ url(Admin_Prefix.'seo-landing/delete/'.$page->id) }}" class="p-1 btn btn-danger" data-confirm="" title="Delete"><i class="fa fa-window-close"></i></a>
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
@section('more-scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.place_order', function(event) {
            event.preventDefault();
        
            var dataId = $(this).closest('form').find('.order_input_id').data('id');
            var val = $(this).closest('form').find('.order_input_id').val(); 
            
            $.ajax({
                url: "{{ route('order_display_seo_result') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token for security
                    id: dataId, // Send the data-id as a parameter
                    val: val // Send the data-id as a parameter
                },
                success: function(response) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                    location.reload(); // Reload the page to reflect changes
                },
                error: function(response) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'An error occurred. Please try again.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                }
            });
        });

    });
</script>
@endsection