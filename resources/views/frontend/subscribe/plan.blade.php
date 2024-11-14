@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/stylej.css') }}">
@section('more-css')  

<style>
   .sticky-aside {
       position: -webkit-sticky;
       position: sticky;
       top: 20px; 
   }
   .jurney .label_head {
       width: 100%;
       background: #181e4e;
       color: #fff;
       padding: 5px;
       border-radius: 5px;
       font-size: 13px;
   }
   .select-custom {
       padding: 3px 4px;
       border-radius: 4px;
       padding-left: 5px;
       margin-left: -6px;
       margin-top: 1px;
       background-color: #e9e9e9;
       border: 1px solid #b8b8b8;
       padding-right: 5px;
   }
   .widget {
       background-image: url(https://project.ambalainfo.com/subscribe/images/subscription-design.png);
   }

   .addons input[type="checkbox"] {
       display: none; /* Hide the checkbox */
   }
   .addons.selected .select-addon{
    background-color: #062c6d;
    border: 1px solid #062c6d;
    color: #fff;
   }
   .addons.selected .price-addon{
    color: #fff;   
   }
    .select-addon{
        align-items: baseline;
        padding-left:10px;
    }
    .select-addon:hover{
        color: #fff;
    }
    .gapNew{
        display: flex;
        gap: 10%;
        padding-left: 20px;
    }
     .next-btn {
        background: #062c6d;
        border: 1px solid #062c6d !important;
        width: 125px;
        height: 45px;
        font-family: 'Poppins';
        border: none;
        color: #ffffff;
        border-radius: 30px;
        font-size: 18px;
        transition: 0.5s ease-in-out;
        line-height: 45px;
        text-align: center;
    }
</style>
@endsection 
@section('content') 
	<div class="container custom-container">
	        @php 
            
        $results = DB::table('digital_service_price_widget')
        ->select(DB::raw('MAX(id) as id'), 'plan_name', DB::raw('MAX(main_price) as price'))
        ->where('service_type', $_GET['service_id'])
        ->where('duration_id', $_GET['duration'])
        ->groupBy('plan_name')
        ->get();
         
        $durtation = DB::table('digital_service_price_widget')
        ->select(DB::raw('MAX(id) as id'), 'plan_duration', DB::raw('MAX(main_price) as price'))
        ->where('plan_duration', '!=', 'half_yearly') // Use where() instead of whereNotIn() for a single value
        ->groupBy('plan_duration')
        ->get();
 
        $duration_name = DB::table('digital_service_price_widget')->where('duration_id', $_GET['duration'])->first(); 
        $result_new = DB::table('digital_service_price_widget')->where('plan_name', $_GET['plan'])->first(); 
        
        $add_on = DB::table('pages')->whereIn('page_name', ['SMO Packages', 'SEO Packages', 'Social Media Ads Packages','Google Ads Packages', 'Content Writing Packages', 'Local SEO Packages', 'Backlink Building Packages', 'Press Release Packages' ])->get();
        
        
        
        $service_name = DB::table('pages')->where('id', $duration_new['service_type'])->first();
        
    @endphp 
		<div class="row main-row">
			<div class="col-md-8 right-side-main">
				<div class="col-lg-12 right-side-upper ">
					<h1>{{ $service_name->page_name }}</h1>
					<p><span class="package_base_price text-warning" data-mainPrice='0'>RS {{ number_format($results[0]->price, 2) }}</span></p> 
				</div>
				<div class="col-lg-12 right-side-lower">
					<p class="sub-head">Customize your {{ $service_name->page_name }} to fit your needs</p>
					<div class="drop-down col-lg-8 gapNew pt-3">
						<div class="select1">
							<p>{{ $service_name->page_name }}</p>
							<label for="subscription"></label>
							<select id="subscription" name="subscription" class="select-custom package_plan">
								<option value="{{ $_GET['plan']}}" selected>{{ ucfirst($_GET['plan']) }}</option>
                                 @foreach($results as $key =>$val)
                                 @if( strtolower($_GET['plan']) != strtolower($val->plan_name))
                                 <option value="{{ $val->plan_name}}">{{ ucfirst($val->plan_name) }}</option>
                                 @endif
                                 @endforeach
							</select>
						</div>
						<div class="select2">
							<p>Billing Cycle</p>
							<label for="subscription"></label>
							<select id="subscription" name="subscription" class="select-custom duration_select plan_duration">
								<option value="{{ $duration_name->plan_duration }}" selected>{{ $duration_name->plan_duration }}</option>
                                 @foreach($durtation as $key1 =>$val1)
                                 @if( $duration_name->plan_duration != $val1->plan_duration)
                                 <option value="{{$val1->plan_duration }}">{{ ucfirst($val1->plan_duration) }}</option>
                                 @endif
                                 @endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-12 right-side-upper mt-4 ">
					<h1>Addons</h1>
					<p>Total Addon Price: <span class="total-addon-price">RS 0.00</span></p>
				</div>
				<div class="col-lg-12 right-side-lower  screen-bottom-set">
					<div class="addon-section col-lg-6"> 
						@php
                            $addonPrices = [
                                'SMO Packages' => 2000,
                                'SEO Packages' => 3000,
                                'Social Media Ads Packages' => 1500,
                                'Google Ads Packages' => 2500,
                                'Content Writing Packages' => 1800,
                                'Local SEO Packages' => 2200,
                                'Backlink Building Packages' => 1600,
                                'Press Release Packages' => 2400,
                            ];
                        @endphp

                        @foreach($add_on as $addon)
                            @php $price = $addonPrices[$addon->page_name] ?? 0;  
                            @endphp
                            <div class="col-lg-12 select1 addons" data-price="{{ $price }}">
                                <label class="select-addon">
                                    <input type="checkbox" class="addon-checkbox addon_price_total" value="{{ $addon->page_name }}" data-price="{{ $price }}">
                                    <div>{{ $addon->page_name }}</div>
                                    <p class="price-addon">RS <span class="">{{ $price }}</span></p>
                                </label>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
			<div class="col-md-4 ">
				<aside class="sidebar">
                    <div class="widget"></div>
                    <div class="lower-section">
                        <h2>SEO Plan</h2>
                        <div class="add side-add">
                            <p>SEO Plan</p> <span class="plan_name">{{ ucfirst($duration_new['plan_name']) }}</span> 
                        </div>
                        <div class="add">
                            <p>Billing Cycle</p> <span class="plan_duration_name">{{ $duration_new['plan_duration'] }}</span> 
                        </div>
                        <div class="add addons-summary" style="display: none;">
                            <p>Addons</p> <span class="selected-addons">None</span> 
                        </div>
                    </div>
                </aside>
			</div>
		</div>
	</div>
	<div class="container-fluid background-footer mt-4  z1">
		<div class="container">
			<div class="col-lg-12  sticky-footer">
				<div class="row">
					<div class="col-lg-3 footer-inner first-div-inner-footer">
						<p class="head-p"><span><i class="fa-brands fa-searchengin"></i></span> SEO Plan</p>
						<p class="category categoryNew">{{ ucfirst($_GET['plan'])}}</p>
						<p class="price"> <span class="package_base_price" data-mainPrice='0'>{{ number_format($results[0]->price, 2) }}</span>/mo</p>
					</div> 
					<div class="col-lg-3 footer-inner">
						<p class="head-p"><span><i class="fa-solid fa-list-check"></i></span> Project Details</p>
						<p class="category">Provide Details About Your Project</p>
					</div>
					<div class="col-lg-3  footer-inner total-div">
						<p class="total">Total</p>
						<p class="net-price">RS <span class="total_main_price"></span></p>
					</div>
					<div class="col-lg-3  btn-div">
						<button class="cancel-btn">Cancel</button>
						<a class="next-btn" id="nextStepLink">Proceed</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- seprate footer for mobile tab -->

	<div class="container-fluid background-footer mt-4 only-mob-tab  z1">
        <div class="container">
            <div class="col-lg-12 sticky-footer">
                <div class="row">
                    <div class="col-lg-6 footer-inner total-div-2">
                        <div class="col-lg-12 hide-section">
                            <div class="col-lg-12 pt-3">
                                <p class="head-p"><span><i class="fa-brands fa-searchengin"></i></span> SEO Plan</p>
                                <p class="category categoryNew">Advance</p>
                                <p class="price">RS 16,200/mo</p>
                            </div>
                            <div class="col-lg-12 pt-3">
                                <p class="head-p"><span><i class="fa-solid fa-list-check"></i></span> Project Details</p>
                                <p class="category">Provide Details About Your Project</p>
                            </div>
                            <div class="col-lg-12 pt-3">
                                <p class="total">Total</p>
                                <p class="net-price">RS 36,200</p>
                            </div>
                        </div>
                        <p class="click-show"><i class="fa-solid fa-bars"></i></p>
                    </div>
                    <div class="col-lg-6 btn-div">
                        <button class="cancel-btn">Cancel</button>
                        <button class="next-btn">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('more-scripts')
<script>
$(document).ready(function(){  
    var main_array = [];
    function updateTotal() {
    let basePrice = parseFloat('{{ number_format($results[0]->price, 2) }}') || 0;
    let totalAddonPrice = 0;
    let selectedAddons = [];

    $('.addon-checkbox:checked').each(function() {
        let addonPrice = parseFloat($(this).data('price')) || 0;
        totalAddonPrice += addonPrice;
        selectedAddons.push($(this).val());
        main_array.push($(this).val());

        $(this).closest('.addons').addClass('selected');
    });

    $('.addon-checkbox:not(:checked)').each(function() { 
        $(this).closest('.addons').removeClass('selected');
    });

    let finalTotal = basePrice + totalAddonPrice;
    $('.total-addon-price').text('RS ' + totalAddonPrice.toFixed(2));
    $('.final-total').text('RS ' + finalTotal.toFixed(2));
    $('.final-total-mobile').text('RS ' + finalTotal.toFixed(2));
 
    if (selectedAddons.length > 0) {
        $('.selected-addons').empty(); 
 
        let ul = $('<ul class="p-0"></ul>');
        selectedAddons.forEach(function(addon) {
            ul.append('<li class="Newli p-0">' + addon + '</li>'); 
        });
 
        $('.selected-addons').append(ul);
        $('.addons-summary').show();
    } else {
        $('.selected-addons').text('None');
        $('.addons-summary').hide();
    }
}


    $('.addon-checkbox').change(updateTotal);
    updateTotal();
    
    function sendData(value1, value2, value3 = "") {
        $('.package_base_price').empty();
        $('.total_main_price').empty();

        $.ajax({
            url: "{{ route('value_total') }}", // URL to the Laravel route
            type: 'POST',
            dataType: 'json',
            data: {
                service_id: "{{ $_GET['service_id'] }}",
                value1: value1,
                value2: value2,
                value3: value3,
                _token: $('meta[name="csrf-token"]').attr('content') // Adding CSRF token
            },
            success: function(response) {
               $('.package_base_price').text('Rs. ' + response.total); 
                $('.package_base_price').attr('data-mainprice', response.total);
                $('.total_main_price').text(response.total);

                // Update the link with the new total
                updateLink(response.total, value3);
                $('#result').html('<pre>' + JSON.stringify(response, null, 2) + '</pre>');
            },
            error: function(xhr, status, error) {
                $('#result').html('<p>Error: ' + error + '</p>');
            }
        });
    }

    // Initialize with package and plan details
    var package_plan = $('.package_plan').val();
    var plan_duration = $('.plan_duration').val();
    var addon_service = $('.add_on_service').val();
    sendData(package_plan, plan_duration, '');

    $(document).on('change', '.package_plan', function() {
        package_plan = $(this).val();
        $('.plan_name').text(package_plan.charAt(0).toUpperCase() + package_plan.slice(1)); 
        $('.categoryNew').text(package_plan.charAt(0).toUpperCase() + package_plan.slice(1)); 
        sendData(package_plan, plan_duration, '');
    });

    $(document).on('change', '.plan_duration', function() {
        plan_duration = $(this).val(); 
        $('.plan_duration_name').text(plan_duration);
        sendData(package_plan, plan_duration, '');
    });

    $(document).on('change', '.add_on_service', function() {
        var addon_service = $(this).val();   
        sendData(package_plan, plan_duration, addon_service);
    });
    
    function updateLink(total, addon_service = "") {
        var main_service = "{{ $_GET['service_id'] }}";
        var baseUrl = "{{ url('purchase_second') }}";
        var routeUrl = `${baseUrl}?order_price=${total}&package_plan=${package_plan}&plan_duration=${plan_duration}&main_service=${main_service}`;
        console.log(routeUrl)
        if (addon_service !== '') {
            routeUrl += `&addon_service=${addon_service}`;
        }
        console.log(routeUrl)
        $('#nextStepLink').attr('href', routeUrl);
    }

    $(document).on('click', '.addon_price_total', function() {
        var package_base_price = parseInt($('.package_base_price').data('mainprice')) || 0;
        var addon_price_total = parseInt($(this).data('price')) || 0;

        var total_new = package_base_price + addon_price_total;
        $('.total_main_price').text(total_new);
    }); 

});
</script>
@endsection