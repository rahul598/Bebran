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
        <?php //echo "<pre>"; print_r($lists); die; ?>
        @php $service = DB::table('pages')->where('id', $services[0]['service_type'])->first(); @endphp
         <input class="form-control service" type="text" name="service" value="{{ $service->page_name }}" readonly disabled />
        </div>  
          <!-- /.card-header -->
          <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
                      <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Price List</button>
                      <!--<button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Half Yearly</button>-->
                      <!--<button class="nav-link" id="nav-yearly-tab" data-toggle="tab" data-target="#nav-yearly" type="button" role="tab" aria-controls="nav-yearly" aria-selected="false">Yearly</button>-->
                    </div>
                  </nav>
                <div class="tab-content p-3 border-0 bg-light" id="nav-tabContent">
                    
                    <div class="tab-pane fade active show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> 
                        <form action="{{ route('price_widget_update_description') }}" method="post">
                            @csrf
                             
                            <div class="row">
                                
                                @foreach($description as $key => $val) 
                                    @php $plan_name =  strtolower($val['plan_name']); @endphp  
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card border-0 shadow p-3">
                                            <div class="row mt-4 px-1">
                                                <div class="col">
                                                    <label for="plan" class="text-dark">Plan {{$val['id']}}</label> 
                                                    <input class="form-control plan" type="text" name="plans[{{$val['id']}}][name]" value="{{ ucfirst($val['plan_name'])}}" readonly disabled/>
                                                </div> 
                                            </div> 
                                            <div class="col mt-2 bg_new py-3 rounded px-1">
                                                <label for="discountPrice" class="text-dark">Plan Small Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="plans[{{$val['id']}}][small_des]" rows="1">{{$val['small_description'] }}</textarea>
                                            </div>
                                            <div class="px-1">
                                                <ul class="list-group mt-4  list-group-flush">
                                                    <label for="discountPrice" class="text-dark">Small Features</label>
                                                    @php $small_data = json_decode($val['small_features']); @endphp
                                                    @foreach($small_data as $sm_data)
                                                    <li class="list-group-item border-0 px-0">
                                                        <input class="form-control discountPrice" type="text" name="plans[{{$val['id']}}][small_features][]" value="{{$sm_data}}"/>
                                                    </li> 
                                                    @endforeach
                                            </ul>
                                            </div>
                                            <div class="px-1">
                                                <label for="discountPrice" class="text-dark">Button Text</label>
                                                <input class="form-control discountPrice" type="text" name="plans[{{$val['id']}}][button_text]" value="{{ $val['button_text'] }}"/>
                                            </div>
                                        </div>
                                    </div>  
                                @endforeach
                                 
                            </div> 
                             <input class="btn btn-success mt-4" name="lite_from_data" type="submit" value="Save Information">
                        </form> 
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="{{ route('price_widget_update', ['id' => isset($duration_list[0]['duration_id']), 'id2' => $services[0]['service_type']]) }}" method="post">
                            @csrf 
                            <div class="row">
                                @foreach($lists as $key => $val) 
                                  
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card border-0 shadow p-3">
                                            <div class="row mt-4 px-1">
                                                <div class="col">
                                                    <label for="plan" class="text-dark">Plan </label>
                                                    <input class="form-control plan" type="text" value="{{ $key }}" readonly disabled/>
                                                </div>
                                                <div class="col">
                                                    <div for="plan" class="invisible">Most Popular</div>
                                                    <label for="plan" class="text-dark mr-5">Most Popular</label>
                                                    <input class="form-check-input most_popular" type="checkbox" 
                                                        value="{{ old('plans[$val][most_popular]', isset($most_popular) && $most_popular[$key] == 1 ? 1 : 0) }}" 
                                                        name="service_id[{{$service_id}}][{{$key}}][most_popular]" id="flexCheckChecked" 
                                                        @if(isset($most_popular) && $most_popular[$key] == 1) checked @endif>
                                                </div>
                                            </div> 
                                            @foreach($val as $key1 => $val1)
                                            @if($key == $val1['plan_name']) 
                                            
                                            <div class="row mt-4 px-1">
                                                <div class="col">
                                                    <label for="mainPrice" class="text-dark">{{$val1['plan_duration']}} Price</label>
                                                    <input class="form-control mainPrice" type="text" name="plans[{{$val1['price_id']}}][main_price]" value="{{ $val1['main_price']}}"/>
                                                </div>
                                                <div class="col">
                                                    <label for="discountPrice" class="text-dark">{{$val1['plan_duration']}} Discount Price</label>
                                                    <input class="form-control discountPrice" type="text" name="plans[{{$val1['price_id']}}][percentage]" value="{{ $val1['percentage']}}" placeholder="Enter Price Percentage"/>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach 
                                        </div>
                                    </div>
                                    
                                @endforeach
                                
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
    }); 
</script>
@stop



