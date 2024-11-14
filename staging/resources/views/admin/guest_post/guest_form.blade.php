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
            <h1 class="m-0 text-dark">{{ __('Contacts') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Contacts') }}</li>
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
                  <!-- Delete button -->
                    <button id="deleteSelected" class="btn btn-danger" style="margin-left: 7px;">Delete Selected</button> 
                  </div> 
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive">
                 <table id="tableData" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="select_all" >All</th>
                            <th style="width:200px">Date</th>
                            <th>Post Title</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @if ($guestPost->count() > 0)
                            @foreach($guestPost as $list)
                                <tr>
                                    <td><input type="checkbox" class="single_check" data-unique-id="{{$list->id}}"></td>
                                    <td style="width: 200px;">{{ date_convert($list->created_at,8) }}</td>
                                    <td>{{ $list->post_title }}</td>
                                    <td>{{ $list->author_name }}</td>
                                    <td>{{ $list->email_address }}</td>
                                    <td>{{ $list->post_content }}</td>
                                    <td>
                                        <a href="{{ url(Admin_Prefix.'delete-guest-form/'.$list->id) }}" class="btn btn-danger" data-confirm="" title="Delete"><i class="fa fa-window-close"></i></a>
                                        <button type="button" class="btn btn-primary details_button" data-toggle="modal" data-target="#exampleModal"
                                        data-id="{{ $list->id }}">
                                         <i class="fas fa-solid fa-box"></i>
                                        </button>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" style="text-align: center;">No Data Found</td>
                            </tr>
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
            $('#tableData').DataTable({
                "processing": true, // Show processing indicator while loading data
                "serverSide": false, // Set to true if using server-side processing
                "searching": true, // Enable search feature
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ], // Set length menu options
                "pageLength": 10, // Default page length
                "language": {
                    "emptyTable": "No data available in table", // Customizable empty table message
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries", // Customizable information message
                    "infoEmpty": "Showing 0 to 0 of 0 entries", // Customizable empty information message
                    "infoFiltered": "(filtered from _MAX_ total entries)", // Customizable filtered information message
                    "lengthMenu": "Show _MENU_ entries", // Customizable length menu message
                    "search": "Search:", // Customizable search label
                    "zeroRecords": "No matching records found", // Customizable zero records message
                    "loadingRecords": "Loading..." // Customizable loading records message
                },
                "columnDefs": [
                    { "orderable": false, "targets": 6 } // Disable ordering on the Action column
                ]
            });
        });
    </script>
    <!-- Your script -->
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
                url: '{{ route("getSessionIdsGuest") }}',
                method: 'GET',
                success: function(response) {
                    let sessionIds = response; 
                    $('.single_check').each(function() {
                    if (sessionIds.includes($(this).data('unique-id').toString())) {
                        $(this).prop('checked', true);
                    }
                });

                // Update "select_all" checkbox
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
                    url: "{{route('addToSessionGuest')}}",
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
                    url: "{{route('removeFromSessionGuest')}}",
                    method: 'POST',
                    data: { ids: ids },
                    success: function(response) {
                        console.log(response.message);
                    }
                });
            }

            // Handle delete button click
            $('#deleteSelected').on('click', function() {
                $.ajax({
                    url: "{{route('deleteFromDatabaseGuest')}}",
                    method: 'POST',
                    success: function(response) {
                        alert(response.message);
                        location.reload(); // Reload the page to reflect changes
                    }
                });
            });
            
            $(document).on('click', '.details_button', function(){ 
                $('.exampleModal .modal-body').empty();
                ids = $(this).data('id');
                console.log(ids);
                $.ajax({ 
                    url: "{{route('guest_lead')}}",
                    method: 'GET',
                    data: { ids: ids },
                    success: function(response) {
                        console.log(response.data);
                         $('.exampleModal .modal-body').append( 
                            '<p id="modal-body-location"><b>Content: </b>' + (response.data.post_content != null ? response.data.post_content : '---') + '</p>' +
                            '<p id="modal-body-budget"><b>Mobile Number: </b>' + (response.data.guest_mobile != null ? response.data.guest_mobile : '---') + '</p>'
                        );
                    }
                }); 
            });
        });
    </script>
@endsection
