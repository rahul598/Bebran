@extends('layouts.admin')
<style>
    .price_widger_container label {
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .btnRemove{
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }
        .form-check{ 
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
          <h1 class="m-0 text-dark">{{ __('Add Plan') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add Plan') }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  
<!-- Main content -->
<section class="content">
  <div class="container-fluid price_widger_container">
    <div class="row card card-primary p-3 shadow mt-4 border-0">
        <div class="col-md-4 pl-0 mb-3">
            <label for="plan" class="text-primary">Relatived Pricing Packages</label> 
        <select class="form-control" name="page_id" id="page_id" required>
            <option>Select Packages</option>
            @foreach($all_pages as $pages)
              <option value="{{ $pages->id }}" @if($pages->id == old('page_id')) selected @endif>{{ $pages->page_name }}</option>
            @endforeach
        </select>
        </div>  
          <!-- /.features card-header -->
           <div class="row">
            <form action="{{ route('price_feature_add') }}" method="post">
                @csrf
                <input type="hidden" name="package_id" value="" class="package_id">
                <div class="col-md-12 mb-4 card shadow p-3 mt-4 border-0 feature_row">
                    <div class="row justify-content-between">
                        <div class="col-md-4 mb-3">
                            <label for="planDuration">Feature Heading</label>
                            <input class="form-control discountPrice" type="text" name="heading_price_widget[1]" id="discountPrice" />
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex flex-column mx-5 px-4">
                                <label class="invisible">1</label>
                                <a class="btn btn-success btnRow" href="javascript:void(0);">
                                    <i class="fas fa-plus"></i> 
                                </a>
                            </div>
                        </div>
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
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody class="show_itm">
                                <tr>
                                    <td>
                                        <input class="form-control mainPrice" type="text" name="subheading_price_widget[1][]" />
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="lite[1][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_lite[1]">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="lite[1][]" id="flexCheckDefault_lite[1]">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input class="form-control mainPrice description" type="text" name="standard[1][]" />
                                            <div class="form-check styledCheckbox">
                                                <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_standard[1]">
                                                <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="standard[1][]" id="flexCheckDefault_standard[1]">
                                                <span class="off">NO</span>
                                                <span class="on">YES</span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input class="form-control mainPrice description" type="text" name="advance[1][]" />
                                            <div class="form-check styledCheckbox">
                                                <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_advance[1]">
                                                <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="advance[1][]" id="flexCheckDefault_advance[1]">
                                                <span class="off">NO</span>
                                                <span class="on">YES</span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input class="form-control mainPrice description" type="text" name="enterprise[1][]" />
                                            <div class="form-check styledCheckbox">
                                                <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckDefault_enterprise[1]">
                                                <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="enterprise[1][]" id="flexCheckDefault_enterprise[1]">
                                                <span class="off">NO</span>
                                                <span class="on">YES</span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btnAdd" href="javascript:void(0);">
                                            <i class="fas fa-plus-lg"></i> Add Plan
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="submit" value="Save Plan Features" class="btn btn-success" name="submit">
            </form>
        </div>
      </div>
      <!-- /.row -->
  </div>
</section>
 
@endsection


@section('more-scripts')
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
        //   var index = $(".clone_row").length;
          var heading_index = $('.discountPrice').length; 
           currentIndex++; // Increment index counter
           
          container.append(` <tr class="clone_row">
                                    <td>
                                        <input class="form-control mainPrice" type="text" name="subheading_price_widget[${heading_index}][]" />
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="lite[${heading_index}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_lite[${heading_index}]_${currentIndex}">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="lite[${heading_index}][]" id="flexCheckChecked_lite[${heading_index}]_${currentIndex}">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="standard[${heading_index}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_standard[${heading_index}]_${currentIndex}">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="standard[${heading_index}][]" id="flexCheckChecked_standard[${heading_index}]_${currentIndex}">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="advance[${heading_index}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_advance[${heading_index}]_${currentIndex}">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="advance[${heading_index}][]" id="flexCheckChecked_advance[${heading_index}]_${currentIndex}">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="enterprise[${heading_index}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_enterprise[${heading_index}]_${currentIndex}">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="enterprise[${heading_index}][]" id="flexCheckChecked_enterprise[${heading_index}]_${currentIndex}">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btnRemove" href="javascript:void(0);"><i class="fas fa-solid fa-trash"></i> Remove</a>
                                    </td>
                                </tr>  
        `);
        });

        // Remove Plan button click event
        $(document).on("click", ".btnRemove", function () {
          $(this).closest(".clone_row").remove(); // Remove the closest row when Remove button is clicked
        });

        $(document).on("click", ".btnRow", function () {
          var container = $(this).closest(".feature_row");
        //   var index = container.find(".show_itm").length+1;
        var heading_id = $('.discountPrice').length+1;
          container.append(`
                <div class="col-md-12 mb-4 mt-4 border-0 feature_row">
            <div class="row justify-content-between">
              <div class="col-md-4 mb-3">
                <label for="planDuration">Feature Heading</label>
                <input class="form-control discountPrice" type="text" name="heading_price_widget[${heading_id}]" id="discountPrice" />
              </div>
              <div class="col-md-2">
                <div class="d-flex flex-column mx-5 px-4">
                  <label class="invisible">1</label>
                  <a class="btn btn-danger btnRemoveRow" href="javascript:void(0);"><i class="fas fa-solid fa-trash"></i></a>
                </div>
              </div>
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
                      <th scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody class="show_itm">
                    <tr>
                                    <td>
                                        <input class="form-control mainPrice" type="text" name="subheading_price_widget[${heading_id}][]" />
                                    </td>
                                    <td>
                                    <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="lite[${heading_id}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_lite[${heading_id}]">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="lite[${heading_id}][]" id="flexCheckChecked_lite[${heading_id}]">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div> 
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="standard[${heading_id}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_standard[${heading_id}]">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="standard[${heading_id}][]" id="flexCheckChecked_standard[${heading_id}]">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div> 
                                    </td>
                                    <td>
                                    <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="advance[${heading_id}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_advance[${heading_id}]">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="advance[${heading_id}][]" id="flexCheckChecked_advance[${heading_id}]">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="d-flex">
                                        <input class="form-control mainPrice description" type="text" name="enterprise[${heading_id}][]" />
                                        <div class="form-check styledCheckbox">
                                            <label class="d-flex form-check-label btn styledCheckbox_label" for="flexCheckChecked_enterprise[${heading_id}]">
                                            <input class="form-check-input umlimited" type="checkbox" value="Inactive" name="enterprise[${heading_id}][]" id="flexCheckChecked_enterprise[${heading_id}]">
                                            <span class="off">NO</span>
                                            <span class="on">YES</span>
                                            </label>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btnAdd" href="javascript:void(0);">
                                            <i class="fas fa-plus-lg"></i> Add Plan
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                </table>
          </div>
          </div>
        `);
        });

        $(document).on("click", ".btnRemoveRow", function () {
          $(this).closest(".feature_row").remove(); // Remove the closest row when Remove button is clicked
        });
 
        
        // Disable the checkbox when text is entered into the input fields
        $(document).on('input', '.description', function() {
            var inputField = $(this);
            var checkbox = inputField.closest('td').find('.umlimited');
    
            // If there's text in the input field, disable the checkbox
            if (inputField.val().trim() != 'Active') {
                checkbox.prop('checked', false);
                checkbox.prop('disabled', true);
            } else { 
                checkbox.prop('disabled', false);
            }
        });
        
         // Change value on click
        $(document).on('click', '.umlimited', function() {  
            if ($(this).is(':checked')) {
                $(this).val('Active');
            } else {
                $(this).val('Inactive');
            }
        }); 
    
        // Initialize the checkbox value on page load
        $(document).on("input", '.umlimited', function(){
            $(this).each(function() {
                if ($(this).is(':checked')) {
                    $(this).val('Active');
                } else {
                    $(this).val('Inactive');
                }
            });
        });
    }); 
</script>
@endsection



