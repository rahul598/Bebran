@extends('layouts.admin')
<style>
    .price_widger_container label {
            font-size: 10px;
            letter-spacing: 0.5px;
        }
        .btnRemove{
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }
        ..form-check{ 
            display: flex !important;
            justify-content: stretch !important; 
            align-items: flex-end !important;
        } 
        .btnAdd{
            width:100px;
        }
        .styledCheckbox label {
          background-color: #e3e3e3;
          border: 0.1rem solid #e3e3e3;
          /*padding: 0.5rem 0.25rem;*/
        }
        .styledCheckbox label span {
          background-color: transparent;
          color: black;
          border-radius: 0.25rem;
          /*padding: 0.375rem 0.75rem;*/
          padding: 0.2rem 0.2rem;
        }
        .styledCheckbox label span.off {
          background-color: red;
          color: white;
        }
        .styledCheckbox * {
          cursor: pointer;
          transition: background-color 0.2s ease-in, color, 0.2s ease-out;
        }
        .styledCheckbox input[type=checkbox] {
          display: none;
        }
        .styledCheckbox input[type=checkbox]:checked ~ span.on {
          background-color: green;
          color: white;
        }
        .styledCheckbox input[type=checkbox]:checked ~ span.off {
          background-color: transparent;
          color: black;
        }
       .styledCheckbox_label{
           /*padding: 0.2rem 0.2rem !important;*/
           padding: 0 !important;
       }
  </style>
@section('content') 

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add Plan Features') }}</h1>
        </div>
        <div class="col-sm-6 d-flex justify-content-end align-items-baseline"> 
            <p class="">Insert new features for same Service</p>
            <a class="btn btn-primary ml-3" href="{{ route('same_service_feature', ['id'=> $services[0]['service_page_id']])}}">
                <i class="fas fa-plus-lg"></i> Add 
            </a> 
        </div>
      </div>
    </div>
  </div>

  
<!-- Main content -->
<section class="content">
  <div class="container-fluid price_widget_container">
    <div class="row card card-primary p-3 shadow mt-4 border-0">
      <div class="col-md-4 pl-0 mb-3">
        <label for="plan" class="text-primary">Related Pricing Packages</label> 
        @php
          $service = DB::table('pages')->where('id', $services[0]['service_page_id'])->first();
        @endphp
        <input class="form-control service" type="text" name="service" value="{{ $service->page_name }}" readonly disabled />
      </div> 

      <div class="row">
    <form action="{{ route('feature_list_update', ['id' => $services[0]['service_page_id']]) }}" method="post">
        @csrf
        <input type="hidden" name="package_id" value="{{ $services[0]['service_page_id'] }}" class="package_id"> 
        
       @foreach($lists as $key => $value) 
    <div class="container-fluid price_widger_container">
        <div class="row p-3 mt-4 border-0">
            <div class="col-md-12 mb-4"> 
                <div class="col-md-12 mb-4 card shadow p-3 mt-4 border-0 feature_row">
                    <div class="row justify-content-between">
                        <div class="col-md-4 mb-3">
                            <label for="planDuration">Feature Heading</label>
                            <input class="form-control" type="text" value="{{ old('heading_price_widget', $value['heading']) }}" name="heading_price_widget[{{ $value['id'] }}]" />
                        </div>
                        <div><a href="javascript:void(0);" class="btn btn-danger delete_button" data-id="{{$value['id'] }}"><i class="bi bi-trash"></i></a></div>
                    </div>
            
                    <div class="detail_table">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Sub Heading</th>
                                    <th scope="col">Lite</th>
                                    <th scope="col">Standard</th>
                                    <th scope="col">Advance</th>
                                    <th scope="col">Enterprise</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="plan-table-body">
                                <tr class="junior_tr">
                                    <td>
                                        @foreach(json_decode($value['subheading'], true) as $subhead)
                                        <input class="form-control mb-2" type="text" value="{{ old('subheading', $subhead) }}" name="subheading_price_widget[{{ $value['id'] }}][]" />
                                        @endforeach
                                    </td>
                                    @foreach(['lite', 'standard', 'advance', 'enterprise'] as $plan)
                                    <td>
                                        @foreach(json_decode($value[$plan], true) as $key1 => $planValue)
                                            @php
                                                $inputId = 'flexCheckDefault_' . $plan . '_' . $value['id'] . '_' . $key1;
                                                $planValue = ucfirst($planValue);
                                            @endphp
                                            <div class="d-flex mb-2">
                                            <input class="form-control description" type="text" data-id="{{ $key1 }}" value="{{ old($plan, $planValue) }}" name="{{ $plan }}[{{ $value['id'] }}][]" @if($planValue == 'Active') disabled @endif />
                                            <div class="form-check styledCheckbox">
                                                <label class="d-flex form-check-label btn styledCheckbox_label" for="{{ $inputId }}">
                                                    <input id="{{ $inputId }}" class="form-check-input umlimited flexCheckDefault" data-id="{{ $key1 }}" type="checkbox" value="{{ old($plan, $planValue == 'Active' ? 'Active' : 'Inactive') }}" name="{{ $plan }}[{{ $value['id'] }}][]" @if($planValue == 'Active') checked @endif>
                                                    <span class="off">NO</span>
                                                    <span class="on">YES</span>
                                                </label>
                                            </div>
                                            </div>
                                        @endforeach
                                    </td>
                                    @endforeach 
                                    <td>
                                        <a class="btn btn-primary btnAdd" href="javascript:void(0);" data-id="{{ $value['id'] }}">
                                            <i class="fas fa-plus-lg"></i> Add Plan
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endforeach

        
        <input type="submit" value="Save Plan Features" class="btn btn-success" name="submit">
    </form>
</div>

  </div>
</section>

 
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
      
    // Disable input when checkbox is checked
    $(document).on("click", ".umlimited", function() {
        
      var dataId = $(this).data('id');
      var descriptionInput = $(this).closest('td').find('input[data-id="' + dataId + '"].description');
        descriptionInput.val("");
        
      // Disable or enable the description input based on checkbox state
      descriptionInput.prop("disabled", $(this).is(":checked"));

      // Clear error message and input value if checkbox is checked
      if ($(this).is(":checked")) {
        descriptionInput.siblings(".error_msg").html("");
        descriptionInput.val("");
      }
    });
    
    
    // Add Plan button click event

        // Function to handle adding new rows within a feature row
    $(document).on("click", ".btnAdd", function() {
    var container = $(this).closest('.detail_table').find('.plan-table-body');
    var index = container.find('.junior_tr').length;
    
    var heading_index = $(this).data('id'); // Use data-id for unique identification 

    container.append(`
        <tr class="junior_tr">
            <td class="pb-0  pt-1">
                <input class="form-control" type="text" name="subheading_price_widget[${heading_index}][]" />
            </td>
            <td class="pb-0 pt-1">
            <div class="d-flex mb-2">
                <input class="form-control description" data-id="{{ $key1 }}" type="text" name="lite[${heading_index}][]" />
                <div class="form-check  styledCheckbox">  
                    <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_${heading_index}_${index}_lite">
                        <input id="flexCheckDefault_${heading_index}_${index}_lite" class="form-check-input umlimited flexCheckDefault" data-id="{{ $key1 }}" type="checkbox" value="Active"  name="lite[${heading_index}][]" >
                        <span class="off">NO</span>
                        <span class="on">YES</span>
                    </label>
                </div>
                </div>
            </td>
            <td class="pb-0 pt-1">
            <div class="d-flex mb-2">
                <input class="form-control description" type="text" data-id="{{ $key1 }}" name="standard[${heading_index}][]" />
                <div class="form-check styledCheckbox">
                    <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_${heading_index}_${index}_standard">
                        <input class="form-check-input umlimited" data-id="{{ $key1 }}" type="checkbox" value="Active" name="standard[${heading_index}][]" id="flexCheckDefault_${heading_index}_${index}_standard"> 
                        <span class="off">NO</span>
                        <span class="on">YES</span>
                    </label>
                </div>
                </div>
            </td>
            <td class="pb-0  pt-1">
            <div class="d-flex mb-2">
                <input class="form-control description" type="text" data-id="{{ $key1 }}" name="advance[${heading_index}][]" />
                <div class="form-check styledCheckbox">
                    <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_${heading_index}_${index}_advance">
                        <input class="form-check-input umlimited" data-id="{{ $key1 }}" type="checkbox" value="Active" name="advance[${heading_index}][]" id="flexCheckDefault_${heading_index}_${index}_advance"> 
                        <span class="off">NO</span>
                        <span class="on">YES</span>
                    </label>
                </div>
                </div>
            </td>
            <td class="pb-0 pt-1">
            <div class="d-flex mb-2">
                <input class="form-control description" type="text" data-id="{{ $key1 }}" name="enterprise[${heading_index}][]" />
                <div class="form-check styledCheckbox">
                    <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_${heading_index}_${index}_enterprise">
                        <input class="form-check-input umlimited" data-id="{{ $key1 }}" type="checkbox" value="Active" name="enterprise[${heading_index}][]" id="flexCheckDefault_${heading_index}_${index}_enterprise"> 
                        <span class="off">NO</span>
                        <span class="on">YES</span>
                    </label>
                </div>
                </div>
            </td>
            <td>
                <a class="btn btn-danger btnRemoveRow" href="javascript:void(0);"><i class="fas fa-solid fa-trash"></i> Remove</a>
            </td>
        </tr>
    `);
});

        
        
        // Function to handle removing rows within a feature row
    $(document).on("click", ".btnRemoveRow", function() {
        $(this).closest('.junior_tr').remove();
    });
    
    
    // Disable the checkbox when text is entered into the input fields
    $(document).on('input', '.description', function() {
       
        var inputField = $(this);
        var checkbox = inputField.closest('label').siblings('.umlimited');

        // If there's text in the input field, disable the checkbox
        if (inputField.val().trim() != 'Active') {
            checkbox.prop('checked', false);
            checkbox.prop('disabled', true);
        } else { 
            checkbox.prop('disabled', false);
        }
    });
    
    
    
        // Initialize the checkbox value on page load 
        
        $(document).on('click', '.umlimited', function(){
            
            var descriptionInput = $(this).closest('label').siblings('.description');
            $(this).each(function(){
                console.log("Initializing: ", $(this).attr('id'));
                if ($(this).is(':checked')) {
                    $(this).val('Active');
                    descriptionInput.val('Active');
                } else {
                    $(this).val('Inactive');
                    descriptionInput.val('Inactive');
                }
            });
        });
        
        // Change value on click
        $(document).on('click', '.umlimited', function() {
            console.log("Clicked: ", $(this).attr('id'));
            var descriptionInput = $(this).closest('label').siblings('.description');
            if ($(this).is(':checked')) {
                $(this).val('Active');
                descriptionInput.val('Active');
            } else {
                $(this).val('Inactive');
                descriptionInput.val('Inactive');
            }
        });

    
  });
 
 
 $(document).on('click', '.delete_button', function(){
     id = $(this).data('id');
     delete_feature_data(id);
 });
 
 function delete_feature_data(id){
    if(confirm('Are you sure you want to delete this data?')) {
        $.ajax({
            url: "{{ route('features_data_delete') }}" , // Replace with your delete URL
            method: 'POST',
            data: {
                _method: 'POST', // Spoof the DELETE method
                _token: '{{ csrf_token() }}', // Include the CSRF token
                id: id // Include the id in the data
            },
            success: function(response) {
                console.log(response.message);
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                console.log('Error deleting data: ' + xhr.responseText);
            }
        });
    }
    else{
        alert('Your Features Data not deleted!')
    }
 }
 
 
</script>
 
@endsection



