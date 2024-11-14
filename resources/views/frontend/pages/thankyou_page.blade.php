@extends('layouts.app')
@section('content') 
<?php
    $cart = json_decode($order->cart);
    
    $service_name = DB::table('pages')->where('id', $cart[0]->service)->first();
    $address = DB::table('client_address')->where('client_id', $order->user_id)->first();
    // echo "<pre>";print_r($address); die;
?>
      <div class="signupsection">
        <div class="container">
           <div class="d-flex align-items-center justify-content-center">
              <div class="purchasetext">
                 <h4>The great big thank you!</h4>
                 <h5>Welcome to BeBran Digital family! We'll take it from here.

                    We've sent a confirmation email to <b>christopher@gmail.com</b>
                 </h5>
              </div>
              <div class="thankimg"><img src="images/thankyouimg4.webp" alt=""></div>
           </div>
           <div class="detailsarea">
              <div class="detailsbox">
                 <h4>Details</h4>
                 <h6>You have purchased the <b>{{ $service_name->page_name }}</b></h6>
                 <h6>You will be charged <b>₹20,000/mo</b></h6>
                 <p>*urabitur leo enim, consectetur pretium quam eu, varius maximus diam. 
                    Cras augue turpis, venenatis ac convallis a, aliquam eget justo. Etiam vitae ipsum nibh. Vivamus id 
                 </p>
              </div>
              <div class="detailsbox">
                 <h3>Primary Contact</h3>
                 <h6>{{ ucfirst($address->bill_first_name) }}</h6>
                 <h6><i class="fa-solid fa-phone-volume"></i> <a href="tel:+91-1234567890">+91-{{ $address->bill_phone }}</a></h6>
                 <h6 class="whatsapp"><i class="fa-brands fa-whatsapp"></i> <a href="#">+91- {{ $address->bill_phone }}</a></h6>
                 <h6><i class="fa-solid fa-envelope"></i> <a href="mailto:{{ $address->bill_email }}">{{ $address->bill_email }}</a></h6>
              </div>
              <div class="detailsbox">
                 <h3>Payment method</h3>
                 <!--<h6><img src="images/cardicon.png" alt=""> <a href="#">Credit/Debit card</a></h6>-->
                 <h6><img src="images/cardicon.png" alt=""> <a href="#">{{ $order->payment_method}}</a></h6>
              </div>
              <div class="detailsbox boxinarea">
                 <h2>Subtotal<span>₹20,000</span></h2>
                 <h2>Tax (GST 18%)<span>₹3,600</span></h2>
                 <h2><b>Total</b><span><b>₹23,600</b></span></h2>
              </div>
              <div class="text-center">
                 <a href="{{ route('user_dashbrad') }}" class="btn-primary">click here to continue</a>
              </div>
           </div>
        </div>
     </div>
@endsection      
     