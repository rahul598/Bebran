@extends('layouts.app')
@section('more-css') 
<style>
    @media(max-width:480px){
        .table_main{
           flex-direction: column-reverse;
        }
        .small_flex{
            justify-content: space-between;
            align-items: baseline; 
        }
    } 
    .service-name{
        width: 400px;
    }
    .plan_duration_cart{
            margin-top: -6px;
    }
     .subtotal table {
            border-collapse: collapse;
            width: 100%;
        }
        .subtotal td {
            padding: 8px;
            text-align: left;
            border: none; /* Borderless table */
        }
        .text-muted {
            color: #6c757d;
        }
</style>
</style>
@endsection
@section('content') 
<section class="container mt-5 pt-5 ">
    <div class="row"> 
        <div class="col-md-8   ">
            <div class="shadow p-4 rounded"> 
                <div class="container pb-4">
                    <?php $arr1 = ['Monthly', 'Quarterly', 'Half Yearly', 'Yearly']; ?>
                    @foreach($arr as $key => $val)
                    <div class="d-flex justify-content-between table_main py-4 border-bottom border-dark">
                        <div class="column service-name">
                            <span class="fs-4">{{$val['service_name']}}</span>
                            <table class="small-features w-100">
                                <tbody>
                                    
                                        <?php $small_features = json_decode($val['small_features']); ?>
                                        @foreach($small_features as $smll_key => $smll_val)
                                        <tr>
                                            <td>{{ $smll_val }}</td>
                                            <td>Rs.0</td>
                                            </tr>
                                        @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="small_flex d-flex">
                            <div class="column pe-4">{{$val['package_name']}}</div>
                            <div class="column plan_duration_cart">
                                <select class="form-select package_duration" name="package_duration" aria-label="Default select example" data-id="{{$val['cart_id']}}">
                                    <option value="{{$val['package_duration']}}" selected>{{$val['package_duration']}}</option>
                                    @foreach($arr1 as $key1 => $val1) 
                                        @if($val['package_duration'] != $val1)
                                            <option value="{{ $val1 }}">{{ ucfirst($val1) }}</option>
                                        @endif
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="column">Rs.{{$val['discount_price']}}</div>
                        <div><buttton class="btn p-0 delete" data-id="{{$val['cart_id']}}"><i class="fa-solid fa-xmark bg-danger text-white p-1 rounded"></i></a></div>
                    </div>
                    <div class="d-flex justify-content-between table_main py-4 border-bottom border-dark">
                        <div class="column service-name">
                            <?php $service_name_addon = DB::table('pages')->where('id', $val['service_addon_id'])->first(); ?>
                            <span class="fs-4">{{$service_name_addon->page_name}}</span> 
                        </div>
                        <div class="small_flex d-flex">
                            <div class="column pe-4"> </div>
                            <div class="column plan_duration_cart">
                                
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column">Rs.{{$val['service_addon_price']}}</div>
                    </div>
                    @endforeach
                    
                </div>

            </div>  
        </div>  
        <div class="col-md-4  "> 
       <div class="shadow  p-4 rounded">
            <div class="card"  >
              <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <hr>
               <table class="subtotal w-100"> 
                        <tr> 
                            <td class="text-muted">
                                Your Subtotal: 
                            </td>
                            <td class="text-muted  main_total">
                                Rs.<span>{{ $subtotal + $addtotal }}</span>
                            </td>
                        </tr>
                        <tr> 
                            <td class="text-muted">
                                Taxes: 
                            </td>
                            <td class="text-muted  ">
                                Rs.<span class="tax"></span>
                            </td>
                        </tr>
                        <tr class="border-top border-dark"> 
                            <td class="text-muted">
                                Total: 
                            </td>
                            <td class="text-muted  ">
                                Rs.<span class="pura_total"></span>
                            </td>
                        </tr>
                    </table>  
                    <div class="d-flex justify-content-end pt-3">
                        <a href="{{ route('checkout.show') }}" class="card-link btn btn-primary">Confirm Order</a> 
                    </div>
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
    var mainServicePrice = parseFloat($('.main_total span').text());  
    var tax = mainServicePrice * 0.18; // Calculate 18% tax
    var totalWithTax = mainServicePrice + tax; 
    
    $('.tax').text( tax.toFixed(2));
    $('.pura_total').text( totalWithTax.toFixed(2));
    
    
    // change cart plan duraiton 
    $(document).on('change', '.package_duration', function() {
        var package_duration = $(this).val(); 
        var cart_id = $(this).data('id'); // or use $(this).attr('data-id'); 
        url = "{{route('change_plan_duration')}}";
        sendData(package_duration, cart_id, url);
    });
    
    // Delete cart
    $(document).on('click', '.delete', function() {   
        var cart_id = $(this).data('id'); // or use $(this).attr('data-id');
        var url = "{{route('delete_cart')}}";
        
        // Confirm before deletion
        if (confirm("Are you sure you want to delete this item from the cart?")) {
            sendData('', cart_id, url);
        }
    });
    
    function sendData(value1="", Cartid, url) {
    //   $('.package_base_price').empty();
        $.ajax({
            url: url, // URL to the Laravel route
            type: 'POST',
            dataType: 'json',
            data: { 
                value1: value1, 
                Cartid: Cartid, 
              _token: $('meta[name="csrf-token"]').attr('content') // Adding CSRF tokenc
            },
            success: function(response) {
               console.log(response);
               if(response.status == 1 ){
                   window.location.reload();
               }
            },
            error: function(xhr, status, error) {
                $('#result').html('<p>Error: ' + error + '</p>');
            }
        });
    }
    
});
</script>
@endsection