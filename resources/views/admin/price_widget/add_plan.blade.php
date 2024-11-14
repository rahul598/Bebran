@extends('layouts.admin')
<style>
    .price_widger_container label {
      font-size: 12px;
      letter-spacing: 0.5px;
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
            <label for="plan" class="text-primary">Related Pricing Packages</label> 
        <select class="form-control" name="page_id" id="page_id" required>
            <option>Select Packages</option>
            @foreach($all_pages as $pages)
              <option value="{{ $pages->id }}" @if($pages->id == old('page_id')) selected @endif>{{ $pages->page_name }}</option>
            @endforeach
        </select>
        </div>   
          <!-- /.card-header -->
          <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Monthly</button>
                      <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Quarterly</button>
                      <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Half Yearly</button>
                      <button class="nav-link" id="nav-yearly-tab" data-toggle="tab" data-target="#nav-yearly" type="button" role="tab" aria-controls="nav-yearly" aria-selected="false">Yearly</button>
                    </div>
                  </nav>
                <div class="tab-content p-3 border-0 bg-light" id="nav-tabContent">
                    
                    <div class="tab-pane fade active show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{ route('price_widget_add')}}" method="post">
                            @csrf
                            <input type="hidden" name="plan_duration" value="Monthly">
                            <input type="hidden" name="package_id" value="" class="package_id">
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
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[standard][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[advance][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
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
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="enterprise" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[enterprise][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
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
                             <input class="btn btn-success mt-4" name="lite_from_data" type="submit" value="Save Information">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="{{ route('price_widget_add')}}" method="post">
                            @csrf
                            <input type="hidden" name="plan_duration" value="Quarterly">
                            <input type="hidden" name="package_id" value="" class="package_id">
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
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[standard][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[advance][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
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
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="enterprise" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[enterprise][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
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
                             <input class="btn btn-success mt-4" name="lite_from_data" type="submit" value="Save Information">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form action="{{ route('price_widget_add')}}" method="post">
                            @csrf
                            <input type="hidden" name="plan_duration" value="Half Yearly">
                            <input type="hidden" name="package_id" value="" class="package_id">
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
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[standard][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[advance][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
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
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="enterprise" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[enterprise][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
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
                             <input class="btn btn-success mt-4" name="lite_from_data" type="submit" value="Save Information">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-yearly" role="tabpanel" aria-labelledby="nav-yearly-tab">
                        <form action="{{ route('price_widget_add')}}" method="post">
                            @csrf
                            <input type="hidden" name="plan_duration" value="Yearly">
                            <input type="hidden" name="package_id" value="" class="package_id">
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
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[lite][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[lite][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[lite][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[standard][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[standard][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[standard][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[standard][small_features][]" />
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
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[advance][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[advance][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[advance][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[advance][small_features][]" />
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
                                                <input class="form-control plan" type="text" name="plans[enterprise][name]" value="enterprise" readonly disabled/>
                                            </div>
                                            <div class="col">
                                                <div for="plan" class="invisible">Most Popular</div>
                                                <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                <input class="form-check-input most_popular" type="checkbox" value="" name="plans[enterprise][most_popular]" id="flexCheckChecked">
                                            </div>
                                        </div>
                                        <div class="row mt-4 px-1">
                                            <div class="col">
                                                <label for="mainPrice" class="text-dark">Main Price</label>
                                                <input class="form-control mainPrice" type="text" name="plans[enterprise][main_price]" />
                                            </div>
                                            <div class="col">
                                                <label for="discountPrice" class="text-dark">Discount Price</label>
                                                <input class="form-control discountPrice" type="text" name="plans[enterprise][discount_price]" />
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
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <input class="form-control discountPrice" type="text" name="plans[enterprise][small_features][]" />
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
                             <input class="btn btn-success mt-4" name="lite_from_data" type="submit" value="Save Information">
                        </form>
                    </div>
                </div> 
      </div>
      <!-- /.row -->
  </div>
</section>
 
@endsection


@section('more-scripts')
<script type="text/javascript">  
    $(document).ready(function () {
        
        $(document).on('change', '#page_id', function(){
            vval = $(this).val();
            $('.package_id').val(vval);
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

      // Remove Plan button click event
      $(document).on("click", ".btnRemove", function () {
        $(this).closest(".clone_row").remove(); // Remove the closest row when Remove button is clicked
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
    }); 
</script>
@stop



