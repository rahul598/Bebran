@extends('layouts.app')
@section('more-css') 
<style>
   .sticky-aside {
   position: -webkit-sticky; /* For Safari */
   position: sticky;
   top: 20px; /* Adjust this value as needed */
   }
   .jurney .label_head{
       width: 100%;
       background: #181e4e;
       color: #fff;
       padding: 5px;
       border-radius: 5px;
       font-size:13px;
   }
</style>
@endsection
@section('content') 
<section class="container mt-5 pt-5">
    @php 
            
        $results = DB::table('digital_service_price_widget')
        ->select(DB::raw('MAX(id) as id'), 'plan_name', DB::raw('MAX(main_price) as price'))
        ->where('service_type', $_GET['service_id'])
        ->where('duration_id', $_GET['duration'])
        ->groupBy('plan_name')
        ->get();
         
        $durtation = DB::table('digital_service_price_widget')
        ->select(DB::raw('MAX(id) as id'), 'plan_duration', DB::raw('MAX(main_price) as price'))
        ->groupBy('plan_duration')
        ->get();
        
        $duration_name = DB::table('digital_service_price_widget')->where('duration_id', $_GET['duration'])->first();
        // service addon's 
        $add_on = DB::table('pages')->whereIn('page_name', ['SMO Packages', 'SEO Packages', 'Social Media Ads Packages','Google Ads Packages', 'Content Writing Packages', 'Local SEO Packages', 'Backlink Building Packages', 'Press Release Packages' ])->get();
        
    @endphp 
   <div class="row">
      <div class="col-md-3">
         <aside class="sticky-aside">
            <div class="shadow rounded" style='border-radius:10% !important;'>
               <div class="card">
                  <div class="card-body">
                     <div class="text-center" style="background-color: lightgrey;    border-top-left-radius: 30px; padding: 20px 0; border-top-right-radius: 30px;">
                        <img src="{{ asset('frontend/images/true_check/server.png') }}" width="30%">
                     </div>
                     <div class="p-4">
                        @php $service_name = DB::table('pages')->where('id', $duration_new['service_type'])->first(); @endphp
                        <h5 class="card-title pb-2" style="color: #181e4e;font-weight:700;">{{ $service_name->page_name}}</h5>
                        <label>Plan Name</label>
                        <h6 class="card-subtitle mb-2 text-muted pt-1 plan_name">{{ $duration_new['plan_name'] }}</h6>
                        <label>Duration</label>
                        <p class="card-text text-muted plan_duration_name">{{ $duration_new['plan_duration'] }}</p>
                     </div>
                  </div>
               </div>
            </div>
         </aside>
      </div>
      <div class="col-md-8 jurney">
         <div class="shadow p-4 rounded">
            
            <div class=" d-none mx-0 px-0 mt-0 pt-0 container-fluid" style="position: relative;" id="TradingView_Widget">
            <div class="mx-0 px-0 mt-0 pt-0 row" style="position: absolute;z-index: 1;width:100%;">
                <div class="mx-0 px-0 tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js">
                            {
                                "symbols": [
                                    {
                                        "description": "SENSEX",
                                        "proName": "INDEX:SENSEX"
                                    },
                                    {
                                        "description": "SBIN",
                                        "proName": "BSE:SBIN"
                                    },
                                    {
                                        "description": "ADANI ENT",
                                        "proName": "BSE:ADANIENT"
                                    },
                                    {
                                        "description": "ICICI BANK",
                                        "proName": "BSE:ICICIBANK"
                                    },
                                    {
                                        "description": "TCS",
                                        "proName": "BSE:TCS"
                                    },
                                    {
                                        "description": "HDFC BANK",
                                        "proName": "BSE:HDFCBANK"
                                    },
                                    {
                                        "description": "RELIANCE",
                                        "proName": "BSE:RELIANCE"
                                    },
                                    {
                                        "description": "INFY",
                                        "proName": "BSE:INFY"
                                    }
                                ],
                                    "showSymbolLogo": true,
                                        "colorTheme": "light",
                                            "isTransparent": false,
                                                "displayMode": "regular",
                                                    "locale": "in"
                            }
                        </script>
                </div>
            </div>
            <div class="mx-0 px-0 mt-0 pt-0 row" id="widget_mobile_view"
                style="position: absolute; width:100%; height:50px;">
            </div>
        </div>
            <form action="{{ route('cart.add') }}" method="GET">
            <input type="hidden" class="form-control" name="service_main" value="{{ $_GET['service_id'] }}">
            <div class="mt-3">
               <div class="mb-3">
                  <label class="mb-3 label_head">Change Plan</label>
                  <select class="form-select package_plan" name="package_plan" aria-label="Default select example">
                     <option value="{{ $_GET['plan']}}" selected>{{ $_GET['plan']}}</option>
                     @foreach($results as $key =>$val)
                     @if( $_GET['plan'] != $val->plan_name)
                     <option value="{{ $val->plan_name}}">{{ ucfirst($val->plan_name) }}</option>
                     @endif
                     @endforeach
                  </select>
               </div>
               <div class="mb-3">
                  <label class="mb-3 mt-3 label_head">Change Plan Duration</label>
                  <select class="form-select plan_duration" name="plan_duration" aria-label="Default select example">
                     <option value="{{ $duration_name->plan_duration }}" selected>{{ $duration_name->plan_duration }}</option>
                     @foreach($durtation as $key1 =>$val1)
                     @if( $duration_name->plan_duration != $val1->plan_duration)
                     <option value="{{$val1->plan_duration }}">{{ ucfirst($val1->plan_duration) }}</option>
                     @endif
                     @endforeach
                  </select>
               </div>
               <div class="mb-3">
                  <label class="mb-3 mt-3 label_head">Add On's</label> 
                  @foreach($add_on as $key_on => $val_on)
                  @if($service_name->page_name != $val_on->page_name) 
                  <div class="form-check">
                     <input class="form-check-input add_on_service" type="radio" name="srvice_addon" id="exampleRadios{{ $key_on }}" value="{{ $val_on->id }}">
                     <label class="form-check-label" for="exampleRadios{{ $key_on }}">
                     {{ $val_on->page_name }}
                     </label>
                  </div>
                  @endif
                  @endforeach
               </div>
                <div>
                     
                 <div class="mb-3 " style="text-align: end; font-size: 22px; font-weight: 700;">Package Base Price: <span class="package_base_price text-warning"></span></div>  
                 
             </div>
            </div>
            <?php
            //   $user = session('client_data');
            //   $userArray = json_decode(json_encode($user), true); 
               ?>
            <!--@if(!empty($userArray))-->
            <!--<button type="submit" class="card-link btn btn-primary">Add To Cart</button>-->
            <!--@else-->
            <div class="d-flex justify-content-end">
                <a href="#" id="nextStepLink" class="card-link btn btn-primary">Next Step</a>

            </div>
            <!--@endif-->
             </form>
             
         </div>
      </div>
   </div>
</section>
@endsection
@section('more-scripts')
<script>
$(document).ready(function(){
    
   function sendData(value1, value2, value3= "") {
       $('.package_base_price').empty();
        $.ajax({
            url: "{{route('value_total')}}", // URL to the Laravel route
            type: 'POST',
            dataType: 'json',
            data: {
                service_id: "{{$_GET['service_id']}}",
                value1: value1,
                value2: value2,
                value3: value3,
              _token: $('meta[name="csrf-token"]').attr('content') // Adding CSRF tokenc
            },
            success: function(response) {
                // console.log(response.total)
                $('.package_base_price').append(response.total);
                
                // Update the link with the new total
                updateLink(response.total, value3);
                $('#result').html('<pre>' + JSON.stringify(response, null, 2) + '</pre>');
            },
            error: function(xhr, status, error) {
                $('#result').html('<p>Error: ' + error + '</p>');
            }
        });
    }
    
    // Get price of package
        var package_plan = $('.package_plan').val();
        var plan_duration = $('.plan_duration').val();
        var addon_service = $('.add_on_service').val();
        sendData(package_plan, plan_duration, '');

        // For plan
        $(document).on('change', '.package_plan', function() {
            package_plan = $(this).val();
            $('.plan_name').empty().append(package_plan);
            sendData(package_plan, plan_duration, '');
        });

        // For duration
        $(document).on('change', '.plan_duration', function() {
            plan_duration = $(this).val();
            $('.plan_duration_name').empty().append(plan_duration);
            sendData(package_plan, plan_duration, '');
        });

        // For addon service
        $(document).on('change', '.add_on_service', function() {
            var addon_service = $(this).val();  
            sendData(package_plan, plan_duration, addon_service);
        });
        
        
        // Function to update the href of the link with the package_base_price value
        function updateLink(total, addon_service = "") {
            var main_service = "{{ $_GET['service_id']}}";
            var baseUrl = "{{ url('purchase-next') }}";
            var routeUrl = `${baseUrl}?order_price=${total}&package_plan=${package_plan}&plan_duration=${plan_duration}&main_service=${main_service}`;
            if(addon_service !== '') {
                routeUrl += `&addon_service=${addon_service}`;
            }
            console.log(routeUrl);  // For debugging
            $('#nextStepLink').attr('href', routeUrl);
        }

});
</script>

@endsection