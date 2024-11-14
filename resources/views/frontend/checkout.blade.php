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
            <div class="py-3 ps-4 text-white rounded-top" style="background-color: #181e4e;"><h6>Receipt Details</h6></div>
            <div class="shadow p-4 rounded-bottom">
                <div class="card-body"> 

                  <form id="checkoutBilling" action="{{ route('checkout') }}" method="POST">
                      @csrf
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-fn">Contact Person Name</label>
                              <input class="form-control" name="bill_first_name" type="text" required="" id="checkout-fn" value="">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-ln">Business Name</label>
                              <input class="form-control" name="bill_business_name" type="text" required="" id="checkout-ln" value="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout_email_billing">E-mail Address</label>
                              <input class="form-control" name="bill_email" type="email" required="" id="checkout_email_billing" value="">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-phone">Phone Number</label>
                              <input class="form-control" name="bill_phone" type="text" id="checkout-phone" required="" value="">
                            </div>
                          </div>
                        </div>
                        <!--<div class="row">-->
                        <!--  <div class="col-sm-12">-->
                        <!--    <div class="form-group">-->
                        <!--      <label for="checkout-company">Company</label>-->
                        <!--      <input class="form-control" name="bill_company" type="text" id="checkout-company" value="">-->
                        <!--    </div>-->
                        <!--  </div>-->
                        <!--</div>-->
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-address1">Tax ID (GSTIN)</label>
                              <input class="form-control" name="tax" required="" type="text" id="checkout-address1" value="">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-address2">Address</label>
                              <input class="form-control" name="bill_address2" type="text" id="checkout-address2" value="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-zip">Zip Code</label>
                              <input class="form-control" name="bill_zip" type="text" id="checkout-zip" value="">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="checkout-city">City</label>
                              <input class="form-control" name="bill_city" type="text" required="" id="checkout-city" value="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="checkout-country">Country</label>
                                <select class="form-control" required="" name="bill_country" id="billing-country">
                                    <option selected="">Choose Country</option>
                                    @foreach($country as $key => $val)  
                                        <option value="{{ $val->name }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        </div>
                
        
        
        
                <!--<div class="form-group">-->
                <!--  <div class="custom-control custom-checkbox">-->
                <!--    <input class="custom-control-input" type="checkbox" id="same_address" name="same_ship_address" checked="">-->
                <!--    <label class="custom-control-label" for="same_address">Same as billing address</label>-->
                <!--  </div>-->
                <!--</div>-->
        
                        <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="trams__condition">
                    <label class="custom-control-label" for="trams__condition">This site is protected by reCAPTCHA and the <a href="https://bebran.com/privacy-policy" target="_blank">Privacy Policy</a> and <a href="https://bebran.com/terms-conditions" target="_blank">Terms of Service</a> apply.</label>
                  </div>
                </div>
                
                <div class="d-flex justify-content-between paddin-top-1x mt-4">
                    <a class="btn btn-primary btn-sm" href="{{ route('cart.show') }}"><span class="hidden-xs-down"><i class="icon-arrow-left"></i>Back To Cart</span></a>
                    <button id="continue__button" class="btn btn-primary  btn-sm" type="submit"><span class="hidden-xs-down">Continue</span><i class="icon-arrow-right"></i></button>
                  </div>
                </form>
            </div>
            </div>  
        </div>  
        <div class="col-md-4  "> 
         <div class="py-3 ps-4 text-white rounded-top" style="background-color: #181e4e;"><h6>Order Summary</h6></div>
           <div class="shadow  p-4 rounded">
            <div class="card" >
                <div class="card-body"> 
                    <h5 class="card-title d-none"><?php //echo "<pre>"; print_r($arr); ?></h5> 
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