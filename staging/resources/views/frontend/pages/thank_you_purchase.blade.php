@extends('layouts.app')
@section('content')
      @foreach ($extra_data as $val)
          @if($val->type==1)
              @php 
                $first_title = $val->title; 
                $first_body = $val->body; 
                $first_image = $val->image; 
              @endphp
          @endif
          @if($val->type==2)
              @php 
                $second_image = $val->image; 
                $second_body = $val->body; 
                $second_btn_text = $val->btn_text; 
                $second_btn_url = $val->btn_url; 
              @endphp
          @endif
      @endforeach
      <div class="signupsection">
        <div class="container">
           <div class="d-flex align-items-center justify-content-center">
              <div class="purchasetext">
                 <h4>{!! $first_title !!}</h4>
                 <h5>{!! $first_body !!}</b>
                 </h5>
              </div>
              <div class="thankimg"><img src="images/thankyouimg4.webp" alt=""></div>
           </div>
           <div class="detailsarea">
              <div class="detailsbox">
                 <h4>Details</h4>
                 <h6>You have purchased the <b>SEO GOld Plan</b></h6>
                 <h6>You will be charged <b>₹20,000/mo</b></h6>
                 <p>*urabitur leo enim, consectetur pretium quam eu, varius maximus diam. 
                    Cras augue turpis, venenatis ac convallis a, aliquam eget justo. Etiam vitae ipsum nibh. Vivamus id 
                 </p>
              </div>
              <div class="detailsbox">
                 <h3>Primary Contact</h3>
                 <h6>Komal Rajput</h6>
                 <h6><i class="fa-solid fa-phone-volume"></i> <a href="tel:+91-1234567890">+91-1234567890</a></h6>
                 <h6 class="whatsapp"><i class="fa-brands fa-whatsapp"></i> <a href="#">+91- 3214567850</a></h6>
                 <h6><i class="fa-solid fa-envelope"></i> <a href="mailto:ask@bebran.com">ask@bebran.com</a></h6>
              </div>
              <div class="detailsbox">
                 <h3>Payment method</h3>
                 <h6><img src="images/cardicon.png" alt=""> <a href="#">Credit/Debit card</a></h6>
              </div>
              <div class="detailsbox boxinarea">
                 <h2>Subtotal<span>₹20,000</span></h2>
                 <h2>Tax (GST 18%)<span>₹3,600</span></h2>
                 <h2><b>Total</b><span><b>₹23,600</b></span></h2>
              </div>
              <div class="text-center">
                 <a href="#" class="btn-primary">click here to continue</a>
              </div>
           </div>
        </div>
     </div>
@endsection      
     