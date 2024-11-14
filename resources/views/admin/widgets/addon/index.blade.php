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
        <h1 class="m-0 text-dark">{{ __('Addon List') }} </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('Addon List') }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid price_widger_container">
    <div class="row card card-primary p-3 shadow mt-4 border-0"> 
          <!-- /.features card-header -->
           <div class="row">
            <form action="{{ route('addonAdd') }}" method="post">
                @csrf  
                    <div class="detail_table">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Addon Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">Per Set Price</th>
                                    <th scope="col">Type</th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody class="show_itm">
                                <tr>
                                    <td>
                                        <input class="form-control mainPrice" type="text" name="addon[]" />
                                    </td>
                                    <td> 
                                        <input class="form-control mainPrice description" type="text" name="quantity[]" />  
                                    </td>
                                    <td> 
                                            <input class="form-control mainPrice description" type="text" name="text[]" />  
                                    </td>
                                    <td> 
                                            <input class="form-control mainPrice description" type="text" name="price[]" />  
                                    </td>
                                    <td style="width:200px !important;"> 
                                            <!--<input class="form-control mainPrice description" type="text" name="type[]" /> -->
                                            <select class="select_new" name="type[0][]" multiple placeholder="Choose Type" data-allow-clear="1">
                                                <option value="oneTime">One Time</option>
                                                <option value="Retainer">Retainer</option> 
                                            </select>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btnAdd" href="javascript:void(0);">
                                            <i class="fas fa-plus-lg"></i> Add Row
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                <input type="submit" value="Save Addons" class="btn btn-success" name="submit">
            </form>
        </div>
      </div>
      <!-- /.row -->
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listing</h3> 
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
        <table id="example2" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
                <th>Id</th>
                <th>Addon Name</th> 
                <th>Quantity</th> 
                <th>Text</th> 
                <th>Price</th> 
                <th>Type</th> 
                <th>Status</th> 
                <th>Action</th> 
            </tr>
          </thead>
          <tbody>
    @if ($addon->count() > 0)
        @php $row = 1; @endphp
        @foreach($addon as $key => $val)
            @php
                $data = json_decode($val->type);
                $formattedData = [];
                
                foreach ($data as $item) {
                    $formattedData[] = ($item === 'oneTime') ? 'One Time' : $item;
                }
                $text = implode(', ', $formattedData);
            @endphp

            <tr>
                <td>{{ $row++ }}</td>
                
                <!-- Editable Addon Name -->
                <td>
                    <input type="text" class="form-control" name="addon_name" form="form_{{ $val->id }}" value="{{ $val->addon_name }}">
                </td>

                <!-- Editable Quantity -->
                <td>
                    <input type="number" class="form-control" name="quantity" form="form_{{ $val->id }}" value="{{ $val->quantity }}">
                </td>

                <!-- Editable Text -->
                <td>
                    <input type="text" class="form-control" name="text" form="form_{{ $val->id }}" value="{{ $val->text }}">
                </td>

                <!-- Editable Price -->
                <td>
                    <input type="number" class="form-control" name="price" form="form_{{ $val->id }}" value="{{ $val->price }}">
                </td>

                <!-- Editable Type as Multi-select -->
                <td>
                    <select class="form-control select2" name="type[]" form="form_{{ $val->id }}" multiple>
                        <option value="oneTime" {{ in_array('oneTime', $data) ? 'selected' : '' }}>One Time</option>
                        <option value="Retainer" {{ in_array('Retainer', $data) ? 'selected' : '' }}>Retainer</option>
                    </select>
                </td>

                <!-- Status Display -->
                <td>
                    <span class="badge bg-{{$val->status == '1' ? 'success' : 'danger'}}">
                        {{ $val->status == '1' ? 'Active' : 'Inactive' }}
                    </span>
                </td>

                <!-- Action Buttons with Form -->
                <td>
                    <form id="form_{{ $val->id }}" action="{{ route('updateDeleteToggleAddon', ['id' => $val->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="form_method_{{ $val->id }}" value="PUT">
                        <input type="hidden" name="action" id="form_action_{{ $val->id }}" value="update">
                        
                        <button type="button" class="btn btn-success p-1" onclick="submitForm('{{ $val->id }}', 'update')">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        
                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger p-1" onclick="submitForm('{{ $val->id }}', 'delete')">
                            <i class="bi bi-trash"></i>
                        </button>
                        
                        <!-- Toggle Status Button -->
                        <button type="button" class="btn {{$val->status != 0 ? 'btn-warning' : 'btn-light'}} p-1" onclick="submitForm('{{ $val->id }}', 'toggle')">
                            <i class="fa fa-fw fa-lightbulb {{$val->status != 1 ? 'inactive' : 'text-white'}}"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="text-center">No Data Found</td>
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
    
    
    function submitForm(id, action) {
        const formMethod = document.getElementById(`form_method_${id}`);
        const formAction = document.getElementById(`form_action_${id}`);
        
        if (action === 'delete') {
            // Show confirmation alert before delete
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    formMethod.value = 'DELETE';
                    formAction.value = action;
                    document.getElementById(`form_${id}`).submit();
                }
            });
        } else if (action === 'toggle') {
            formMethod.value = 'PATCH';
            formAction.value = action;
            document.getElementById(`form_${id}`).submit();
        } else {
            formMethod.value = 'PUT';
            formAction.value = action;
            document.getElementById(`form_${id}`).submit();
        }
    }

    </script>
</script>
<script type="text/javascript">  
    $(document).ready(function () { 
        
        // disbabled input
        $(document).on("click", ".umlimited", function () {
            
        //   var descriptionInput = $(this).parent().siblings(".description");
          var descriptionInput = $(this).closest('td').find('input.description');
           
          // Disable or enable the description input based on checkbox state
          descriptionInput.prop("disabled", $(this).is(":checked"));

          // Clear error message if checkbox is checked
          if ($(this).is(":checked")) {
            descriptionInput.siblings(".error_msg").html("");
            descriptionInput.val("");
          }
        });  
        
        
        $(document).on('change', '#page_id', function(){
            vval = $(this).val();
            alert(vval)
            $('.package_id').val(vval);
        });
        
      // Add Plan button click event
        var currentIndex = 0;
        $(document).on("click", ".btnAdd", function () { 
            
          var container = $(this).closest(".show_itm"); 
          var heading_index = $('.discountPrice').length; 
           currentIndex++;  
           var rowIndex = $('.clone_row').length+1;
           
          container.append(`<tr class="clone_row">
                                <td>
                                    <input class="form-control mainPrice" type="text" name="addon[]" />
                                </td>
                                <td>
                                    <div class="d-flex">
                                    <input class="form-control mainPrice description" type="text" name="quantity[]" /> 
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                    <input class="form-control mainPrice description" type="text" name="text[]" /> 
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                    <input class="form-control mainPrice description" type="text" name="price[]" /> 
                                    </div>
                                </td>
                                <td style="width:200px !important;"> 
                                        <select class="select_new" name="type[${rowIndex}][]" multiple placeholder="Choose Type" data-allow-clear="1">
                                            <option value="oneTime">One Time</option>
                                            <option value="Retainer">Retainer</option> 
                                        </select>  
                                </td>
                                <td>
                                    <a class="btn btn-danger btnRemove" href="javascript:void(0);"><i class="fas fa-solid fa-trash"></i> Remove</a>
                                </td>
                            </tr>`);
                            
                            initializeSelect2();
        });

        $(document).on("click", ".btnRemove", function () {
          $(this).closest(".clone_row").remove(); 
        }); 

        $(document).on("click", ".btnRemoveRow", function () {
          $(this).closest(".feature_row").remove();  
        });
 
        $(document).on('input', '.description', function() {
            var inputField = $(this);
            var checkbox = inputField.closest('td').find('.umlimited');
     
            if (inputField.val().trim() != 'Active') {
                checkbox.prop('checked', false);
                checkbox.prop('disabled', true);
            } else { 
                checkbox.prop('disabled', false);
            }
        });
         
        $(document).on('click', '.umlimited', function() {  
            if ($(this).is(':checked')) {
                $(this).val('Active');
            } else {
                $(this).val('Inactive');
            }
        }); 
     
        $(document).on("input", '.umlimited', function(){
            $(this).each(function() {
                if ($(this).is(':checked')) {
                    $(this).val('Active');
                } else {
                    $(this).val('Inactive');
                }
            });
        });
        
        
        
        function initializeSelect2() {
            $('.select_new').each(function () {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        }
        
         initializeSelect2();
    }); 
    
    
    
</script>
@endsection
