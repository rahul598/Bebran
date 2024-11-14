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
    .p2{
        padding-left: 4px !important;
        padding-right: 4px !important;
    }
    .m3{
        margin: 0 3px;
    }
</style>
@endsection
@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
@endphp
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
               <a href="{{ route('featureUploadPage') }}" class="btn btn-success">Upload Features Entries</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
        <table id="example2" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
                <th>Id</th>
                <th>Service Name</th> 
                <th>Service Id</th> 
                <th>Action</th> 
            </tr>
          </thead>
          <tbody>
              @php $row = 1 @endphp
              @foreach($lists as $key => $val)
              @php $service = DB::table('pages')->where('id', $val['service_page_id'])->first(); @endphp
           <tr>
                <td>{{ $row++ }}</td>
                <td>{{  $service->page_name }}</td> 
                <td>{{  $val['service_page_id'] }}</td> 
                <td class="d-flex" style="align-items: flex-start;">
                    <a href="{{ route('feature_list_edit', ['id'=>$val['service_page_id']]) }}" class="m3 p2 btn btn-success p-0 d-none"><i class="fa fa-fw fa-edit"></i></a>
                     
                    <a href="{{ route('price_data_download_features',['id'=>$val['service_page_id']]) }}" class="btn btn-warning m3 p2 p-0 text-white"><i class="fa fa-download"></i></a> 
                    <a class="m3">
                        <form  action="javascript:void(0);" class="uploadForm" method="post" enctype="multipart/form-data">
                            <label data-id="{{ $val['service_page_id'] }}" for="uploadFile_{{$val['service_page_id']}}" class="file-label newDataUpload2 btn-success  btn  secondColor text-dark btn p2 p-0 text-white" >
                                <!--style="font-weight:400;background:#f36944 !important;"-->
                                <i class="fa fa-solid fa-upload"></i>
                            </label>
                            <input type="hidden" data-id="{{ $val['service_page_id'] }}" class="serviceTypeInput">
                            <input type="file" class="d-none uploadFile" id="uploadFile_{{$val['service_page_id']}}" name="file" accept=".csv"> 
                        </form> 
                    <a> 
                    <a href="{{ route('feature_list_delete', ['id'=>$val['service_page_id']]) }}" data-confirm="" class="m3 p2  p-0 btn btn-danger"><i class="fa fa-fw fa-window-close"></i></a>
                </td> 
            </tr> 
            @endforeach
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $('.dataTable').dataTable({
             searching: false
         });
         
         $(document).on('change', '.uploadFile', function() {
             var $this = $(this);
                var form = $(this).closest('.uploadForm')[0]; // Get the form element
                var formData = new FormData(form);
            
                var serviceType = $this.closest('form').find('.newDataUpload2').data('id'); 
                formData.append('service_type', serviceType);
                
                console.log(formData)
                // Proceed with the AJAX request
                $.ajax({
                    url: "{{ route('features_list_upload') }}", // Your endpoint route
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 0) {
                            // Clear any previous error messages
                            $('.po_select_err').empty();
            
                            // Create a table to display the error message
                            var errorTable = '<table class="table table-bordered">';
                            errorTable += '<thead><tr><th>Service ID</th><th>Error Message</th></tr></thead><tbody>';
                            errorTable += '<tr><td>' + response.data + '</td><td>' + response.message + '</td></tr>';
                            errorTable += '</tbody></table>';
            
                            // Append the error table to the po_select_err div
                            $('.po_select_err').append(errorTable);
                        } else {
                            // Display success notification using Swal
                            Swal.fire({
                                icon: 'success',
                                title: 'File uploaded successfully',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didClose: function() {
                                    location.reload();  // Reload the page when the alert is closed
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ', error);
                        console.log('File upload failed: ' + xhr.responseText);
                    }
                });
            });
    });
</script>
@endsection
