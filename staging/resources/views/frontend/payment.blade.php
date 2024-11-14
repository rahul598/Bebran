@extends('layouts.app')
@section('more-css') 
<style>
    .form-group label {
        margin-bottom: 8px;
        padding-left: 1px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
    }
    .payment-methods {
        display: flex;
        flex-wrap: wrap;
    }
    .payment-methods .single-payment-method {
        width: 33.33%;
        padding-left: 10px;
        padding-right: 10px;
        margin-bottom: 20px;
    }
    .payment-methods .single-payment-method a {
        display: block;
        border: 1px solid #f5f5f5;
        padding: 20px 10px;
        text-align: center;
        background: #f5f6f9;
    }
    .text-decoration-none {
        text-decoration: none !important;
    }
    .modal{
        z-index: 9999 !important;
    }
    .payment_gate_imag{
        height:50px; 
    }
    table {
            border-collapse: collapse;
            width: 100%;
        }
        td {
            padding: 8px;
            text-align: left;
            border: none; /* Borderless table */
        }
        .text-muted {
            color: #6c757d;
        }
</style>
@endsection
@section('content') 
<section class="container mt-5 pt-5 ">
    <div class="row"> 
        <div class="col-md-8   "> 
            <div class="shadow p-4 rounded">
            <div class="card">
                        <div class="card-body">
                            <h6 class="pb-2 widget-title2">{{ __('Review Your Order') }} :</h6>
                            
                            <div class="row">
                                <div class="col-sm-9 mb-4">
                                    <h6 class="fz-16-bold">{{ __('Billing Address') }} :</h6>
                                    @php
     
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                    <ul class="list-unstyled pt-2"> 
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_first_name) }}</li>
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_business_name) }}</li>
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_email) }}</li>
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_phone) }}</li> 
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_address) }}</li>
                                    </ul>
                                    <ul class="list-unstyled pt-2"> 
                                       
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->tax) }}</li>
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_zip) }}</li>
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_city) }}</li>
                                        <li><span class="text-muted pay-label">{{ ucfirst($client_address->bill_country) }}</li>
                                        
                                    </ul>
                                </div>
                                </div>
                            </div>
     
                            <h6 class="pb-2 widget-title2">{{ __('Pay With') }} :</h6>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="payment-methods">
                                        @php
                                            $gateways = DB::table('payment_settings')->whereStatus(1)->get();
                                        @endphp
                                        @foreach ($gateways as $gateway) 
                                                @if ($gateway->unique_keyword != 'cod')
                                                    <div class="single-payment-method">
                                                        <a class="text-decoration-none " href="#" data-bs-toggle="modal"
                                                            data-bs-target="#{{ $gateway->unique_keyword }}">
                                                            <img class="payment_gate_imag"
                                                                src="{{ asset('uploads/' . $gateway->photo) }}"
                                                                alt="{{ $gateway->name }}" title="{{ $gateway->name }}" >
                                                            <p>{{ $gateway->name }}</p>
                                                        </a>
                                                    </div>
                                                @endif 
                                        @endforeach
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>  
            @include('frontend.inc.checkout_modal')
        </div>  
        <div class="col-md-4  "> 
           <div class="shadow  p-4 rounded">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                   <?php $arr = session()->get('cart_vlaue'); ?> 
                    <hr>
                    <table>
                        <tr>
                            <td class="text-muted  ">
                                Main Package Price: 
                            </td>
                            <td class="text-muted main_serviec_price">
                                <?php echo $arr[0]['main_serviec_price']; ?> 
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted  ">
                                Your Package Addon:  
                            </td>
                            <td class="text-muted addon_serviec_price">
                               <?php echo $arr[0]['addon_serviec_price']; ?>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="text-muted  ">
                                Taxes & Fees <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-placement="top" title="Taxes & Fees includes 18% GST.">
  <i class="fa-solid fa-circle-exclamation"></i></button>:  
                            </td>
                            <td class="text-muted  ">
                               <?php echo number_format($arr['tax'], 2);?>
                            </td>
                        </tr> 
                        <tr> 
                            <td class="text-muted">
                                Your Subtotal: 
                            </td>
                            <td class="text-muted  ">
                                <?php echo number_format($arr['total_with_tax'], 2);?>
                            </td>
                        </tr>
                    </table>  
                </div>
                </div> 
            </div>  
        </div>
    </div>
</section>
@endsection
@section('more-scripts')
<script>
$(document).ready(function(){
    var mainServicePrice = parseFloat($('.main_serviec_price').text());
    var addonServicePrice = parseFloat($('.addon_serviec_price').text()); 
    
    var total = mainServicePrice + addonServicePrice;
    var tax = total * 0.18; // Calculate 18% tax
    var totalWithTax = total + tax;

    $('.tax').text( tax.toFixed(2));
    $('.subtotal').text( totalWithTax.toFixed(2));
});
</script>
@endsection