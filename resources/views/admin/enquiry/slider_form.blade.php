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
            <h1 class="m-0 text-dark">{{ __('Slider Form Data') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Slider Form') }}</li>
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
                  <div class="d-flex justify-content-start mb-4">
                     <h3 class="card-title">Choose Excel File (csv)</h3>
                    <form action="{{ url(Admin_Prefix.'importData') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex justify-content-start">
                        @csrf
                        <input type="file" name="file" class="ml-3 form-file">
                        <button type="submit" class="btn btn-success">Import</button>
                    </form>
                    <form action="{{ url(Admin_Prefix.'sampleFile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     <button class="btn btn-success ml-2">Sample File</button>
                    </form>
                    <form action="{{ route('body_slider_csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     <button class="btn btn-danger ml-2">Export</button>
                    </form> 
                    <!-- Delete button -->
                    <button id="deleteSelected" class="btn btn-danger" style="margin-left: 7px;">Delete Selected</button>
                  </div>
                     <div class="card-tools listing_page w-100">
                        <form action="" class="d-flex justify-content-between">
                           <div class="input-group input-group-sm">
                              <label for="from" class="mr-2 mt-1">From</label>
                              <input type="text" id="from" name="from" autocomplete="off" value="{{ $fromDate ?? '' }}">
                              <label for="to" class="mr-2 ml-2 mt-1">to</label>
                              <input type="text" id="to" name="to" autocomplete="off" value="{{ $toDate ?? '' }}">
                           </div>
                           <div class="input-group input-group-sm">
                              <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="">
                              <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                              </div>
                           </div>
                        </form> 
                     </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive">
                  <table id="tableData" class="table table-bordered table-hover dataTable">
                     <thead>
                        <tr>
                           <th style="padding-left: 10px;"><input type="checkbox" class="select_all" > All</th>
                           <th style="width:200px">Date</th> 
                           <th>Name</th> 
                           <th>Phone</th>
                           <th>Service</th> 
                           <th>Website Url</th> 
                           <th>Message</th> 
                         </tr>
                     </thead>
                     <tbody>
                         @php $row = 1;  @endphp
                         @foreach($contact_us as $key => $val)
                          @php $service_name = DB::table('pages')->where('id', $val->page_id)->first();  @endphp
                        <tr>
                            <td><input type="checkbox" class="single_check" data-unique-id="{{$val->id}}">  </td> 
                            <td>{{ $formattedDate = date_convert($val->created_at,8) }}</td>
                            <td>{{  $val->first_name }}</td>
                            <td>{{  $val->phone }}</td>
                            <td>{{  $val->service_name}}</td>
                            <td>{{  $val->website }}</td>
                            <td>
                                <button type="button" class="btn btn-primary details_button" data-toggle="modal" data-target="#exampleModal"
                                data-id="{{ $val->id }}">
                                 <i class="fas fa-solid fa-box"></i>
                                </button>
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
<!-- Modal -->
<div class="modal fade exampleModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <p id="modal-body-page"></p>
        <p id="modal-body-location"></p>
        <p id="modal-body-budget"></p>
        <p id="modal-body-email"></p>
        <p id="modal-body-skype"></p>
        <p id="modal-body-whatsapp"></p>
        <p id="modal-body-role"></p>
        <p id="modal-body-message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

@endsection
@section('more-scripts')  
<script>
        $(document).ready(function() {
            // CSRF token for AJAX requests (Laravel)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Fetch session IDs on page load and set checkboxes 
            $.ajax({
                url: '{{ route("getSessionIds") }}',
                method: 'GET',
                success: function(response) {
                    console.log('Received session IDs:', response);
                    
                    // Extract values from the response object
                    let sessionIds = Object.values(response);
                    // console.log('Extracted session IDs:', sessionIds);
            
                    if (!Array.isArray(sessionIds)) {
                        console.error('Error: sessionIds is not an array');
                        return;
                    }
                    
                    $('.single_check').each(function() {
                        let uniqueId = $(this).data('unique-id').toString();
                        // console.log('Processing checkbox with ID:', uniqueId);
                        
                        if (sessionIds.includes(uniqueId)) {
                            // console.log('Checking checkbox with ID:', uniqueId);
                            $(this).prop('checked', true);
                        } else {
                            // console.log('Unchecking checkbox with ID:', uniqueId);
                            $(this).prop('checked', false);
                        }
                    });
            
                    if ($('.single_check:checked').length === $('.single_check').length) {
                        $('.select_all').prop('checked', true);
                    } else {
                        $('.select_all').prop('checked', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching session IDs:', error);
                }
            });

            // Handle click on "select_all" checkbox
            $('.select_all').on('click', function() {
                let ids = [];
                $('.single_check').each(function() {
                    $(this).prop('checked', $('.select_all').prop('checked'));
                    ids.push($(this).data('unique-id'));
                });
                if ($('.select_all').prop('checked')) {
                    addIdsToSession(ids);
                } else {
                    removeIdsFromSession(ids);
                }
            });

            // Handle click on individual checkboxes
            $('.single_check').on('click', function() {
                let id = $(this).data('unique-id');
                if ($(this).prop('checked')) {
                    addIdsToSession([id]);
                } else {
                    removeIdsFromSession([id]);
                }

                // Update "select_all" checkbox
                if ($('.single_check:checked').length === $('.single_check').length) {
                    $('.select_all').prop('checked', true);
                } else {
                    $('.select_all').prop('checked', false);
                }
            });

            // Function to add IDs to session
            function addIdsToSession(ids) {
                $.ajax({
                    url: "{{route('addToSession')}}",
                    method: 'POST',
                    data: { ids: ids },
                    success: function(response) {
                        console.log(response.message);
                    }
                });
            }

            // Function to remove IDs from session
            function removeIdsFromSession(ids) {
                $.ajax({
                    url: "{{route('removeFromSession')}}",
                    method: 'POST',
                    data: { ids: ids },
                    success: function(response) {
                        console.log(response.message);
                    }
                });
            }

            // Handle delete button click
            $('#deleteSelected').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('deleteFromDatabase') }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}' // Include CSRF token for security
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
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
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
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                });
                            }
                        });
                    }
                });
            });
            
            $(document).on('click', '.details_button', function(){ 
                $('.exampleModal .modal-body').empty();
                ids = $(this).data('id');
                $.ajax({ 
                    url: "{{route('get_data_lead')}}",
                    method: 'GET',
                    data: { ids: ids },
                    success: function(response) {
                        console.log(response.data);
                         $('.exampleModal .modal-body').append(
                            '<p id="modal-body-page"><b>Belong To: </b>' + (response.pageName != null ? response.pageName : '---') + '</p>' +
                            '<p id="modal-body-location"><b>Location: </b>' + (response.data.location != null ? response.data.location : '---') + '</p>' +
                            '<p id="modal-body-budget"><b>Budget: </b>' + (response.data.budget != null ? response.data.budget : '---') + '</p>' +
                            '<p id="modal-body-email"><b>Email: </b>' + (response.data.email != null ? response.data.email : '---') + '</p>' +
                            '<p id="modal-body-skype"><b>Skype: </b>' + (response.data.skype != null ? response.data.skype : '---') + '</p>' +
                            '<p id="modal-body-whatsapp"><b>WhatsApp: </b>' + (response.data.whatsapp != null ? response.data.whatsapp : '---') + '</p>' +
                            '<p id="modal-body-role"><b>Role: </b>' + (response.data.role != null ? response.data.role : '---') + '</p>' +
                            '<p id="modal-body-message"><b>Message: </b>' + (response.data.message != null ? response.data.message : '---') + '</p>'
                        );

                    }
                }); 
            });

        });
</script>
@endsection
