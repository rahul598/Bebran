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
            <h1 class="m-0 text-dark">{{ __('Client Purchase Data') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Client Purchase Form') }}</li>
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
               <div class="card-header d-none">
                  <div class="d-flex justify-content-start mb-4"> 
                     <form action="{{ url(Admin_Prefix.'exportTableData/'.'client_sign_up') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     <button class="btn btn-danger ml-2">Export</button>
                  </form>  
                  </div> 
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive">
                  <table id="tableData" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="select_all" >All</th>
                            <th>First Name</th> 
                            <th>Last Name</th> 
                            <th>Email</th> 
                            <th>Phone</th> 
                            <th style="width:200px">Date</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @php $row = 1; @endphp
                        @foreach($contact_us as $key => $val)
                        <tr>
                            <td><input type="checkbox" class="single_check" data-unique-id="{{$val->id}}">  </td> 
                            <td>{{ $val->first_name }}</td>
                            <td>{{ $val->last_name }}</td>
                            <td>{{ $val->email }}</td> 
                            <td>{{ $val->phone }}</td> 
                            <td>{{ date_convert($val->created_at, 8) }}</td>
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
$(document).ready(function () {
    var checkedValues = [];
    $('.select_all').each(function() {
        if ($(this).is(':checked') && !$(this).is(':disabled')) {
          var checkboxValue = $(this).val();
          checkedValues.push(checkboxValue);
        }
    });
    
    // select all 
    
    $(document).on('show.bs.modal','.exampleModal',  function(event) {
            $('.exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var location = button.data('location');
            var budget = button.data('budget');
            var email = button.data('email');
            var skype = button.data('skype');
            var whatsapp = button.data('whatsapp');
            var role = button.data('role');
            var message = button.data('message');
            
            var modal = $(this); 
            modal.find('#modal-body-location').html('<b>Location: ' + location);
            modal.find('#modal-body-budget').html('<b>Budget: </b>' + budget);
            modal.find('#modal-body-email').html('<b>Email: </b>' + email);
            modal.find('#modal-body-skype').html('<b>Skype: </b>' + skype);
            modal.find('#modal-body-whatsapp').html('<b>WhatsApp: </b>' + whatsapp);
            modal.find('#modal-body-role').html('<b>Role: </b>' + role);
            modal.find('#modal-body-message').html('<b>Message: </b>' + message);
        });
    });
});
</script>
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
            "zeroRecords": "No matching records found" // Customizable zero records message
        }
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
                url: '{{ route("getSessionIdsClient") }}',
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
                    url: "{{route('addToSessionClient')}}",
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
                    url: "{{route('removeFromSessionClient')}}",
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
                    url: "{{route('deleteFromDatabaseClient')}}",
                    method: 'POST',
                    success: function(response) {
                        alert(response.message);
                        location.reload(); // Reload the page to reflect changes
                    }
                });
            });
        });
    </script>
@endsection
