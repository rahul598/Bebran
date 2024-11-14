@extends('layouts.admin')
<style>
    .price_widger_container label {
      font-size: 12px;
      letter-spacing: 0.5px;
    }
    
    .RetainerRate{
        display:none;
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
        <div class="col-md-8 pl-0 mb-3 d-flex">
            <div class="mr-3">
                <label for="plan" class="text-primary">Related Pricing Packages</label> 
                <select class="form-control page_id" name="page_id" id="page_id" required>
                    <option>Select Packages</option>
                    @foreach($all_pages as $pages)
                      <option value="{{ $pages->id }}" @if($pages->id == old('page_id')) selected @endif>{{ $pages->page_name }}</option>
                    @endforeach
                </select>
                <div class="package_error small text-danger"></div>
            </div>   
            <div>
                <label for="plan" class="text-primary">Service Type</label> 
                <select class="form-control typeService" name="servicetype" id="servicetype" required>
                    <option>Select Type</option> 
                      <option value="oneTime">One Time</option> 
                      <option value="retainer">Retainer</option> 
                </select>
                <div class="package_error small text-danger"></div>
            </div>   
        </div>   
          <!-- /.card-header -->
          <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Small Description</button>
                      <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">All Price</button>
                      <!--<button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Half Yearly</button>-->
                      <!--<button class="nav-link" id="nav-yearly-tab" data-toggle="tab" data-target="#nav-yearly" type="button" role="tab" aria-controls="nav-yearly" aria-selected="false">Yearly</button>-->
                    </div>
                  </nav>
                <div class="tab-content p-3 border-0 bg-light" id="nav-tabContent">
                    
                    <div class="tab-pane fade active show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="javascript:void(0);" method="post" id="planForm">
                            @csrf 
                            <input type="hidden" name="package_id" value="" class="package_id">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[lite][name]" value="Lite" readonly disabled/>
                                            </div> 
                                        </div> 
                                        <div class="col mt-2 bg_new py-3 rounded px-1">
                                            <label for="discountPrice" class="text-dark">Plan Small Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="plans[lite][small_des]" rows="1"></textarea>
                                        </div>
                                        <div class="px-1">
                                            <ul class="list-group mt-4  list-group-flush">
                                                <label for="discountPrice" class="text-dark">Small Features</label>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[lite][small_features][]" required aria-describedby="discountPrice_1_error" />
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[lite][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[lite][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[lite][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[lite][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                        </ul>
                                        </div>
                                        <div class="px-1">
                                            <label for="discountPrice" class="text-dark">Button Text</label>
                                            <input class="form-control discountPrice" type="text" name="plans[lite][button_text]" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[standard][name]" value="Standard" readonly disabled/>
                                            </div> 
                                        </div> 
                                        <div class="col mt-2 bg_new py-3 rounded px-1">
                                            <label for="discountPrice" class="text-dark">Plan Small Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="plans[standard][small_des]" rows="1"></textarea>
                                        </div>
                                        <div class="px-1">
                                            <ul class="list-group mt-4  list-group-flush">
                                                <label for="discountPrice" class="text-dark">Small Features</label>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[standard][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[standard][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[standard][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[standard][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[standard][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                        </ul>
                                        </div>
                                        <div class="px-1">
                                            <label for="discountPrice" class="text-dark">Button Text</label>
                                            <input class="form-control discountPrice" type="text" name="plans[standard][button_text]" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[advance][name]" value="Advance" readonly disabled/>
                                            </div> 
                                        </div> 
                                        <div class="col mt-2 bg_new py-3 rounded px-1">
                                            <label for="discountPrice" class="text-dark">Plan Small Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="plans[advance][small_des]" rows="1"></textarea>
                                        </div>
                                        <div class="px-1">
                                            <ul class="list-group mt-4  list-group-flush">
                                                <label for="discountPrice" class="text-dark">Small Features</label>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[advance][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[advance][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[advance][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[advance][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[advance][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                        </ul>
                                        </div>
                                        <div class="px-1">
                                            <label for="discountPrice" class="text-dark">Button Text</label>
                                            <input class="form-control discountPrice" type="text" name="plans[advance][button_text]" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="Enterprise" readonly disabled/>
                                            </div> 
                                        </div> 
                                        <div class="col mt-2 bg_new py-3 rounded px-1">
                                            <label for="discountPrice" class="text-dark">Plan Small Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="plans[enterprise][small_des]" rows="1"></textarea>
                                        </div>
                                        <div class="px-1">
                                            <ul class="list-group mt-4  list-group-flush">
                                                <label for="discountPrice" class="text-dark">Small Features</label>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[enterprise][small_features][]" required aria-describedby="discountPrice_1_error"required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[enterprise][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[enterprise][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[enterprise][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice discount_1" type="text" name="plans[enterprise][small_features][]" required aria-describedby="discountPrice_1_error"/>
                                                     
                                                </li>
                                        </ul>
                                        </div>
                                        <div class="px-1">
                                            <label for="discountPrice" class="text-dark">Button Text</label>
                                            <input class="form-control discountPrice" type="text" name="plans[enterprise][button_text]" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <input class="btn btn-success mt-4 submitButton" id="submitBtn" name="lite_from_data" type="submit" value="Save Information">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="javascript:void(0);" method="post" id="priceForm" class="priceRate">
                            @csrf
                            <input type="hidden" name="plan_duration" value="Quarterly">
                            <input type="hidden" name="package_id" value="" class="package_id">
                            <input type="hidden" name="type_Value" value="" class="type_Value">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3"> 
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[lite][name]" value="Lite" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[lite][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Monthly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Monthly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quarterly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][quarterly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Quarterly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Half Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][half_yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Half Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][half_yearly][discount_price]" placeholder="Enter Price Percentage" />
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[standard][name]" value="Standard" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[standard][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Monthly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Monthly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quarterly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][quarterly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Quarterly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Half Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][half_yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Half Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][half_yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[advance][name]" value="Advance" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[advance][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Monthly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Monthly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quarterly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][quarterly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Quarterly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Half Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][half_yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Half Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][half_yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3">
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="Enterprise" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[enterprise][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Monthly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Monthly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quarterly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][quarterly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Quarterly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Half Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][half_yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Half Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][half_yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Yearly Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][yearly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Yearly Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                    </div>
                                </div>
                            </div>
                             <input class="btn btn-success mt-4 " id="priceFormButton" name="lite_from_data" type="submit" value="Save Price All">
                        </form>
                        <form action="javascript:void(0);" method="post" id="RetainerForm" class="RetainerRate">
                            @csrf
                            <input type="hidden" name="plan_duration" value="Quarterly">
                            <input type="hidden" name="package_id" value="" class="package_id">
                            <input type="hidden" name="type_Value" value="" class="type_Value">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3"> 
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[lite][name]" value="Lite" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <label for="plan" class="text-dark">Main Price</label> 
                                                <input class="form-control plan" type="text" name="plans[lite][price]" />
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[lite][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quantity</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[lite][quarterly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[lite][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[lite][half_yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[lite][half_yearly][discount_price]" placeholder="Enter Price Percentage" />
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[lite][yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[lite][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                         <!-----------second Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[lite][second][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[lite][second][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------second Yearly----------->
                                         <!-----------Thrid Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[lite][thrid][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[lite][thrid][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Thrid Yearly----------->
                                    </div>
                                </div>
 
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3"> 
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[standard][name]" value="standard" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <label for="plan" class="text-dark">Main Price</label> 
                                                <input class="form-control plan" type="text" name="plans[standard][price]" />
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[standard][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quantity</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[standard][quarterly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[standard][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[standard][half_yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[standard][half_yearly][discount_price]" placeholder="Enter Price Percentage" />
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[standard][yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[standard][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                         <!-----------second Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[standard][second][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[standard][second][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------second Yearly----------->
                                         <!-----------Thrid Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[standard][thrid][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[standard][thrid][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Thrid Yearly----------->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3"> 
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[advance][name]" value="advance" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <label for="plan" class="text-dark">Main Price</label> 
                                                <input class="form-control plan" type="text" name="plans[advance][price]" />
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[advance][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quantity</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[advance][quarterly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[advance][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[advance][half_yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[advance][half_yearly][discount_price]" placeholder="Enter Price Percentage" />
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[advance][yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[advance][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                         <!-----------second Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[advance][second][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[advance][second][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------second Yearly----------->
                                         <!-----------Thrid Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[advance][thrid][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[advance][thrid][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Thrid Yearly----------->
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-0 shadow p-3"> 
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="plan" class="text-dark">Plan</label> 
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="enterprise" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <label for="plan" class="text-dark">Main Price</label> 
                                                <input class="form-control plan" type="text" name="plans[enterprise][price]" />
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[enterprise][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <!-----------Monthly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Quantity</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][monthly][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][monthly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Monthly----------->
                                        <!-----------Quarterly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][quarterly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][quarterly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div> 
                                        <!-----------Quarterly----------->
                                        <!-----------Half Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][half_yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][half_yearly][discount_price]" placeholder="Enter Price Percentage" />
                                            </div>
                                        </div> 
                                         <!-----------Half Yearly----------->
                                         <!-----------Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][yearly][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][yearly][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Yearly----------->
                                         <!-----------second Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][second][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][second][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------second Yearly----------->
                                         <!-----------Thrid Yearly----------->
                                        <div class="row mt-4 px-1">
                                            <div class="col"> 
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][thrid][main_price]" />
                                            </div>
                                            <div class="col"> 
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][thrid][discount_price]" placeholder="Enter Price Percentage"/>
                                            </div>
                                        </div>
                                        <!-----------Thrid Yearly----------->
                                    </div>
                                </div>
                            </div>
                             <input class="btn btn-success mt-4 " id="RetainerFormButton" name="lite_from_data_retainer" type="submit" value="Save Retainer Price">
                        </form>
                    </div> 
                </div> 
      </div>
      <!-- /.row -->
  </div>
</section>
 
@endsection


@section('more-scripts')
<script> 
$(document).ready(function() { 
    // Initialize validation for the form
    // initializeRetainerFormValidation();

    $(document).on('click', '#RetainerFormButton', function() {   
        alert("Button clicked!");  

        let selectedValue = $('#page_id').val();

        if (!selectedValue || selectedValue === 'Select Packages') {
            $('.package_error').text('Please Select Package');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select a package!',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            return; 
        }

        if (!$("#RetainerForm").valid()) {
            // Stop if form validation fails
            return;
        }

        let formData = $("#RetainerForm").serialize();
        console.log("Serialized form data:", formData); 

        $.ajax({
            url: "{{ route('price_widget_retainer') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred: ' + response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred: ' + (xhr.responseText || 'Unknown error'),
                });
            }
        });
    });

    // Initialize form validation
    function initializeRetainerFormValidation() {
        $("#RetainerForm").validate({
            rules: {
                "plans[lite][monthly][main_price]": { required: true, number: true },
                "plans[lite][monthly][discount_price]": { required: true, number: true },
                "plans[lite][quarterly][main_price]": { required: true, number: true },
                "plans[lite][quarterly][discount_price]": { required: true, number: true },
                "plans[lite][half_yearly][main_price]": { required: true, number: true },
                "plans[lite][half_yearly][discount_price]": { required: true, number: true },
                "plans[lite][yearly][main_price]": { required: true, number: true },
                "plans[lite][yearly][discount_price]": { required: true, number: true },
                "plans[standard][monthly][main_price]": { required: true, number: true },
                "plans[standard][monthly][discount_price]": { required: true, number: true },
                "plans[standard][quarterly][main_price]": { required: true, number: true },
                "plans[standard][quarterly][discount_price]": { required: true, number: true },
                "plans[standard][half_yearly][main_price]": { required: true, number: true },
                "plans[standard][half_yearly][discount_price]": { required: true, number: true },
                "plans[standard][yearly][main_price]": { required: true, number: true },
                "plans[standard][yearly][discount_price]": { required: true, number: true },
                "plans[advance][monthly][main_price]": { required: true, number: true },
                "plans[advance][monthly][discount_price]": { required: true, number: true },
                "plans[advance][quarterly][main_price]": { required: true, number: true },
                "plans[advance][quarterly][discount_price]": { required: true, number: true },
                "plans[advance][half_yearly][main_price]": { required: true, number: true },
                "plans[advance][half_yearly][discount_price]": { required: true, number: true },
                "plans[advance][yearly][main_price]": { required: true, number: true },
                "plans[advance][yearly][discount_price]": { required: true, number: true },
                "plans[enterprise][monthly][main_price]": { required: true, number: true },
                "plans[enterprise][monthly][discount_price]": { required: true, number: true },
                "plans[enterprise][quarterly][main_price]": { required: true, number: true },
                "plans[enterprise][quarterly][discount_price]": { required: true, number: true },
                "plans[enterprise][half_yearly][main_price]": { required: true, number: true },
                "plans[enterprise][half_yearly][discount_price]": { required: true, number: true },
                "plans[enterprise][yearly][main_price]": { required: true, number: true },
                "plans[enterprise][yearly][discount_price]": { required: true, number: true },
            },
            messages: {
                "plans[lite][monthly][main_price]": {
                    required: "Please provide a monthly price for Lite plan",
                    number: "Please enter a valid number"
                },
                "plans[lite][monthly][discount_price]": {
                    required: "Please provide a monthly discount price for Lite plan",
                    number: "Please enter a valid number"
                },
                // Add custom messages for other fields...
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    }
});

</script>
<script type="text/javascript">  
    $(document).ready(function () {
        
        $(document).on('click', '.typeService', function(){
            let value = $(this).val();
            if(value == 'retainer'){
                console.log(value);
                $('.RetainerRate').show();
                $('.priceRate').hide();
            }
            else{
                $('.priceRate').show();
                $('.RetainerRate').hide();
            }
        });
        
        $(document).on('change', '#page_id', function(){
            vval = $(this).val();
            $('.package_id').val(vval);
        });
        $(document).on('change', '#servicetype', function(){
            vval = $(this).val();
            $('.type_Value').val(vval);
        });
        
        
      // Add Plan button click event

      $(document).on('click',".btnAdd",function () {
        var container = $(this).closest('.show_itm');
        container.append(`
        <div class="container-fluid">
          <div class="row clone_row show_itm" id="show_itm">
            <div class="col">
              <label for="plan">Plan</label>
              <select name="planDuration" class="form-control planDuration" name="plan[]" aria-label="Plan Duration">
                <option value="1">Lite</option>
                <option value="2">Standard</option>
                <option value="3">Advance</option>
                <option value="4">Enterprise</option>
              </select>
            </div>
            <div class="col">
              <label for="mainPrice">Main Price</label>
              <input class="form-control mainPrice" type="text" name="main_price[]" />
            </div>
            <div class="col">
              <label for="discountPrice">Discount Price</label>
              <input class="form-control discountPrice" type="text" name="discount_price[]" />
            </div>
            <div class="col">
              <label for="discountPrice">Plan Small Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="small_des[]" rows="1"></textarea>
            </div>
            <div class="col">
              <div class="d-flex flex-column mx-5">
                <label class="invisible">Plan Duration</label>
                <a class="btn btn-danger btnRemove" href="javascript:void(0);"><i class="bi bi-trash"></i> Remove</a>
              </div>
            </div>
          </div>
          </div>
        `);
      });
      
      
      // form validation 
      // Add custom validation rules
    // Form validation initialization
    $("#planForm").validate({
        rules: { 
            // Validation rules for lite plan
            "plans[lite][small_des]": {
                required: true,
                minlength: 5
            }, 
            "plans[lite][button_text]": {
                required: true,
                minlength: 2
            },
            // Validation rules for standard plan
            "plans[standard][small_des]": {
                required: true,
                minlength: 5
            }, 
            "plans[standard][button_text]": {
                required: true,
                minlength: 2
            },
            // Validation rules for advance plan
            "plans[advance][small_des]": {
                required: true,
                minlength: 5
            }, 
            "plans[advance][button_text]": {
                required: true,
                minlength: 2
            },
            // Validation rules for enterprise plan
            "plans[enterprise][small_des]": {
                required: true,
                minlength: 5
            }, 
            "plans[enterprise][button_text]": {
                required: true,
                minlength: 2
            }
        },
        messages: { 
            // Custom error messages for lite plan
            "plans[lite][small_des]": {
                required: "Please provide a small description for Lite plan",
                minlength: "Description must be at least 5 characters long"
            }, 
            "plans[lite][button_text]": {
                required: "Please provide a button text for Lite plan",
                minlength: "Button text must be at least 2 characters long"
            },
            // Custom error messages for standard plan
            "plans[standard][small_des]": {
                required: "Please provide a small description for Standard plan",
                minlength: "Description must be at least 5 characters long"
            }, 
            "plans[standard][button_text]": {
                required: "Please provide a button text for Standard plan",
                minlength: "Button text must be at least 2 characters long"
            },
            // Custom error messages for advance plan
            "plans[advance][small_des]": {
                required: "Please provide a small description for Advance plan",
                minlength: "Description must be at least 5 characters long"
            }, 
            "plans[advance][button_text]": {
                required: "Please provide a button text for Advance plan",
                minlength: "Button text must be at least 2 characters long"
            },
            // Custom error messages for enterprise plan
            "plans[enterprise][small_des]": {
                required: "Please provide a small description for Enterprise plan",
                minlength: "Description must be at least 5 characters long"
            }, 
            "plans[enterprise][button_text]": {
                required: "Please provide a button text for Enterprise plan",
                minlength: "Button text must be at least 2 characters long"
            }
        }, 
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Validation for discount inputs (example provided)
    $(document).on("input", ".discount_1", function() {
        const input = $(this);
        const errorElement = $("#discountPrice_1_error");
        const value = input.val().trim();

        // Basic validation (replace with your specific rules)
        if (isNaN(value) || value === "") {
            errorElement.text("Please enter a valid number.");
            input.addClass("is-invalid");
        } else {
            errorElement.text("");
            input.removeClass("is-invalid");
        }
    });

    // // Validation for select element (page_id)
    // $('form').submit(function(event) {
        
    // });

    $('#page_id').change(function() {
        let selectedValue = $(this).val();

        if (selectedValue && selectedValue !== 'Select Packages') {
            $('.package_error').text('');
        }
    });
        // form validation 
    
    $("#submitBtn").click(function(e) {
        e.preventDefault();
        
        let selectedValue = $('#page_id').val();

        // Check if the selected value is empty or the default option "Select Packages"
        if (!selectedValue || selectedValue === 'Select Packages') {
            $('.package_error').text('Please Select Package');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select a package!',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            return; // Prevent form submission
        }
        
        if ($("#planForm").valid()) {
            $.ajax({
                url: "{{ route('add_plan_description_data') }}", 
                type: "POST",
                data: $("#planForm").serialize(),
                success: function(response) {
                    // handle success response
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }).then(() => {
                        // Reload the page after the alert is dismissed
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // handle error response
                    let errorMessage = 'An error occurred';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Get the first error message
                        errorMessage = Object.values(xhr.responseJSON.errors)[0][0];
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });
        }
    }); 
        
        
      // Remove Plan button click event
      $(document).on("click", ".btnRemove", function () {
        $(this).closest(".clone_row").remove(); // Remove the closest row when Remove button is clicked
      });
    }); 
</script>

<script>
     $(document).ready(function() { 
         
    function initializePriceFormValidation() {
        $("#priceForm").validate({
            rules: {
                "plans[lite][monthly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][monthly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][quarterly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][quarterly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][half_yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][half_yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[lite][yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][monthly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][monthly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][quarterly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][quarterly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][half_yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][half_yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[standard][yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][monthly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][monthly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][quarterly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][quarterly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][half_yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][half_yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[advance][yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][monthly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][monthly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][quarterly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][quarterly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][half_yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][half_yearly][discount_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][yearly][main_price]": {
                    required: true,
                    number: true
                },
                "plans[enterprise][yearly][discount_price]": {
                    required: true,
                    number: true
                }
            },
            messages: {
                "plans[lite][monthly][main_price]": {
                    required: "Please provide a monthly price for Lite plan",
                    number: "Please enter a valid number"
                },
                "plans[lite][monthly][discount_price]": {
                    required: "Please provide a monthly discount price for Lite plan",
                    number: "Please enter a valid number"
                },
                // Similarly, add custom messages for other fields...
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });
    }

    $("#priceFormButton").click(function(e) {
        e.preventDefault(); 
        
        initializePriceFormValidation();
        let selectedValue = $('#page_id').val();
 
        if (!selectedValue || selectedValue === 'Select Packages') {
            $('.package_error').text('Please Select Package');
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select a package!',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            return; 
        }

        // Check if the form is valid
        if ($("#priceForm").valid()) {
            let formData = $("#priceForm").serialize();
            console.log("Serialized form data:", formData); // Log serialized data for debugging


            $.ajax({
                url: "{{ route('price_widget_add') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    // handle success response
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred: ' + response.message,
                        });
                    }
                    
                },
                error: function(xhr, status, error) {
                    // handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred: ' + xhr.responseText,
                    });
                }
            });
        }
    });
}); 
</script>

@stop



