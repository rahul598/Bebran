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
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add Addons') }} <a href="{{ url(Admin_Prefix.'seoResultCategory/add') }}" class="btn btn-primary d-none">Add</a></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!--<li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>-->
            <!--<li class="breadcrumb-item active">{{ __('Widgets') }}</li>-->
            <a href="" class="btn btn-primary">
                  Back
            </a>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
<!-- Main content -->
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



