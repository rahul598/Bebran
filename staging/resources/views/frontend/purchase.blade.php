@extends('layouts.app')
@section('more-css')
<link rel="stylesheet" href="{{ asset('frontend/css/stylej.css') }}">
<style>
   .sticky-aside {
       position: -webkit-sticky; /* For Safari */
       position: sticky;
       top: 20px; /* Adjust this value as needed */
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
    
</style>
@endsection

@section('content') 
<section class="clearfix">
    @php 
        $results = DB::table('digital_service_price_widget')
            ->select(DB::raw('MAX(id) as id'), 'plan_name', DB::raw('MAX(main_price) as price'))
            ->where('service_type', $_GET['service_id'])
            ->where('duration_id', $_GET['duration'])
            ->groupBy('plan_name')
            ->get();
        
        $duration = DB::table('digital_service_price_widget')
            ->select(DB::raw('MAX(id) as id'), 'plan_duration', DB::raw('MAX(main_price) as price'))
            ->groupBy('plan_duration')
            ->get();
        
        $service_name = DB::table('pages')->where('id', $_GET['service_id'])->first(); 
        $add_on = DB::table('pages')->whereIn('page_name', ['SMO Packages', 'SEO Packages', 'Social Media Ads Packages', 'Google Ads Packages', 'Content Writing Packages', 'Local SEO Packages', 'Backlink Building Packages', 'Press Release Packages'])->get();
    @endphp  

    <div class="container custom-container">
        <div class="row main-row">
            <div class="col-md-8 right-side-main">
                <div class="col-lg-12 right-side-upper">
                    <h1>{{ $service_name->page_name }}</h1>
                    <p><span class="package_base_price text-warning">RS {{ number_format($results[0]->price, 2) }}</span></p> 
                </div>
                <div class="col-lg-12 right-side-lower">
                    <p class="sub-head">Customize your SEO Plan to fit your needs</p>
                    <div class="drop-down col-lg-6">
                        <div class="select1">
                            <p>SEO Plan</p>
                            <label for="subscription"></label>
                            <select class="package_plan select-custom" name="package_plan">
                                @foreach($results as $val)
                                    <option value="{{ $val->plan_name }}" data-price="{{ $val->price }}"
                                        @if($val->plan_name === 'Standard') selected @endif>
                                        {{ ucfirst($val->plan_name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select2">
                            <p>Billing Cycle</p>
                            <select class="plan_duration select-custom" name="plan_duration">
                                @foreach($duration as $dur)
                                    <option value="{{ $dur->plan_duration }}" data-price="{{ $dur->price }}"
                                        @if($dur->plan_duration === 'Monthly') selected @endif>
                                        {{ ucfirst($dur->plan_duration) }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 right-side-upper mt-4">
                    <h1>Addons</h1>
                    <p>Total Addon Price: <span class="total-addon-price">RS 0.00</span></p>
                </div>
                <div class="col-lg-12 right-side-lower screen-bottom-set">
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
                            @php $price = $addonPrices[$addon->page_name] ?? 0; @endphp
                            <div class="col-lg-12 select1 addons" data-price="{{ $price }}">
                                <label class="select-addon">
                                    <input type="checkbox" class="addon-checkbox" value="{{ $addon->page_name }}" data-price="{{ $price }}">
                                    <div>{{ $addon->page_name }}</div>
                                    <p class="price-addon">RS {{ number_format($price, 2) }}</p>
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
                            <p>SEO Plan</p> <span>Advance</span> 
                        </div>
                        <div class="add">
                            <p>Billing Cycle</p> <span>Monthly</span> 
                        </div>
                        <div class="add addons-summary" style="display: none;">
                            <p>Addons</p> <span class="selected-addons">None</span> 
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="container-fluid background-footer mt-4">
        <div class="container">
            <div class="col-lg-12 sticky-footer">
                <div class="row">
                    <div class="col-lg-3 footer-inner first-div-inner-footer">
                        <p class="head-p"><span><i class="fa-brands fa-searchengin"></i></span> SEO Plan</p>
                        <p class="category">Advance</p>
                        <p class="price">RS 16,200/mo</p>
                    </div> 
                    <div class="col-lg-3 footer-inner">
                        <p class="head-p"><span><i class="fa-solid fa-list-check"></i></span> Project Details</p>
                        <p class="category">Provide Details About Your Project</p>
                    </div>
                    <div class="col-lg-3 footer-inner total-div">
                        <p class="total">Total</p>
                        <p class="net-price final-total">RS 16,200</p>
                    </div>
                    <div class="col-lg-3 btn-div">
                        <button class="cancel-btn">Cancel</button>
                        <button onclick="location.href='{{ route('purchase_next') }}'" class="next-btn">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- separate footer for mobile tab -->
    <div class="container-fluid background-footer mt-4 only-mob-tab">
        <div class="container">
            <div class="col-lg-12 sticky-footer">
                <div class="row">
                    <div class="col-lg-6 footer-inner total-div-2">
                        <div class="col-lg-12 hide-section">
                            <div class="col-lg-12 pt-3">
                                <p class="head-p"><span><i class="fa-brands fa-searchengin"></i></span> SEO Plan</p>
                                <p class="category">Advance</p>
                                <p class="price">RS 16,200/mo</p>
                            </div>
                            <div class="col-lg-12 pt-3">
                                <p class="head-p"><span><i class="fa-solid fa-list-check"></i></span> Project Details</p>
                                <p class="category">Provide Details About Your Project</p>
                            </div>
                            <div class="col-lg-12 pt-3">
                                <p class="total">Total</p>
                                <p class="net-price final-total-mobile">RS 16,200</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 btn-div">
                        <button class="cancel-btn">Cancel</button>
                        <button onclick="location.href='{{ route('purchase_next') }}'" class="next-btn">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function updateTotal() {
        let basePrice = parseFloat('{{ number_format($results[0]->price, 2) }}');
        let totalAddonPrice = 0;
        let selectedAddons = [];

        $('.addon-checkbox:checked').each(function() {
            let addonPrice = parseFloat($(this).data('price'));
            totalAddonPrice += addonPrice;
            selectedAddons.push($(this).val());

            // Add the selected class for styling
            $(this).closest('.addons').addClass('selected');
        });

        $('.addon-checkbox:not(:checked)').each(function() {
            // Remove the selected class if the checkbox is not checked
            $(this).closest('.addons').removeClass('selected');
        });

        let finalTotal = basePrice + totalAddonPrice;
        $('.total-addon-price').text('RS ' + totalAddonPrice.toFixed(2));
        $('.final-total').text('RS ' + finalTotal.toFixed(2));
        $('.final-total-mobile').text('RS ' + finalTotal.toFixed(2));

        // Update selected add-ons in the sidebar
        if (selectedAddons.length > 0) {
            $('.selected-addons').text(selectedAddons.join(', '));
            $('.addons-summary').show();
        } else {
            $('.selected-addons').text('None');
            $('.addons-summary').hide();
        }
    }

    // Event listener for add-on checkboxes
    $('.addon-checkbox').change(updateTotal);

    // Initialize the total on page load
    updateTotal();
});
</script>

@section('more-scripts')
<script>
    document.querySelector('.click-show').addEventListener('click', function() {
        document.querySelector('.show-content').classList.toggle('show');
    });
</script>
@endsection