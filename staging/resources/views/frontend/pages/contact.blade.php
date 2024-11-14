@extends('layouts.app')
@section('content')

@foreach ($extra_data as $val)
@php $page_id = $val->page_id; @endphp

   @if($val->type==1)
      @php $image = $val->image; @endphp
   @elseif($val->type==6)
      @php
         $title = $val->title;
         $body = $val->body;
      @endphp
   @elseif($val->type==2)
      @php
         $second_title = $val->title;
         $second_sub_title = $val->sub_title;
      @endphp
   @elseif($val->type==3)
      @php
         $third_title = $val->title;
         $third_sub_title = $val->sub_title;
      @endphp
   @elseif($val->type==4)
      @php
         $fourth_title = $val->title;
         $fourth_sub_title = $val->sub_title;
      @endphp
   @elseif($val->type==5)
      @php
         $fifth_title = $val->title;
         $fifth_sub_title = $val->sub_title;
      @endphp            
   @endif
@endforeach
<div class="innerbanner-area">
      <img src="{{ asset('uploads/'.$image) }}" alt="{{ getImageNameAlt($image) }}">
   <nav class="breadcrumb">
      <div class="container">
         <a class="breadcrumb-item" href="{{url('/')}}">home</a>
         <span class="breadcrumb-item active">{{ $page->page_name}}</span>
      </div>
   </nav>
</div>
<section class="innercontact_area">
   <div class="container">
      <div class="contact_innerpage">
         <div class="row ">
            <div class="col-lg-7 order-2">
               <div class="contact_formbox">
                  <div class="webtext">
                     <h2>{!! $title !!}</h2>
                     {!! $body !!}
                  </div>
                  <form method="post" action="{{ url('contact_us') }}" id="contactform" autocomplete="off">
                     @csrf
                     @if (session('success'))
                           <div class="alert alert-success">
                              {{ session('success') }}
                           </div>
                     @endif
                     <div class="row">
                        <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
                        <input type="hidden" name="number_new" class="form-control number_new" value="">
                        <div class="col-lg-6">
                           <div class="form-floating mb-3">
                              <input type="text" class="form-control" name="first_name"  placeholder="First Name" value="{{old('first_name')}}" required>
                              <label>First Name</label>
                              @if ($errors->has('first_name'))
                              <span class="text-danger">{{ $errors->first('first_name') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-floating mb-3">
                              <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                              <label>Last Name</label>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-floating mb-3">
                              <input type="email" class="form-control" name="email"  placeholder="name@example.com" value="{{old('email')}}" required>
                              <label>Email</label>
                              @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-floating mb-3">
                              <!--<input type="number" class="form-control" name="phone" placeholder="Phone Number" value="{{old('phone')}}" maxlength="12" required>-->
                              <input type="number" class="form-control mobile_code" id="mobile_code" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                              <!--<label>Phone</label>-->
                              @if ($errors->has('phone'))
                              <span class="text-danger">{{ $errors->first('phone') }}</span>
                              @endif
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-floating">
                              <textarea class="form-control" name="message" placeholder="Leave a comment here"  style="height: 80px">{{old('message')}}</textarea>
                              <label >Message</label>
                           </div>
                        </div>
                     </div>
                     <div class="captcha_box">
                        <!-- <img src="{{ asset('frontend/images/be-bran-captchanew.webp ')}}" alt="be-bran-captchanew"> -->
                     <div id="html_element"></div>
                              @if ($errors->has('g-recaptcha-response'))
                              <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                              
                              @elseif ($errors->has('recaptcha_validate'))
                              <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                              @endif
                     </div>
                     <input type="submit" class="btn-primary" value="Submit Now">
                  </form>
               </div>
            </div>
            <div class="col-lg-5 contact_rightbox order-1">
               <div class="contact_rightboxinner">
                  
                  <div class="media">
                     <div class="inn-cntct-icon"><i class="fa-solid fa-location-dot"></i></div>
                     <div class="media-body">
                        <h5>{{ $second_title }}</h5>
                        {!! $second_sub_title !!}
                     </div>
                  </div>
                  <div class="media">
                     <div class="inn-cntct-icon"><i class="fa-solid fa-phone"></i></div>
                     <div class="media-body">
                        <h5>{{ $third_title }}</h5>
                        <p><a href="tel:919007259682">{{ $third_sub_title }}</a></p>
                     </div>
                  </div>
                  <div class="media">
                     <div class="inn-cntct-icon"><i class="fa-solid fa-envelope"></i></div>
                     <div class="media-body">
                        <h5>{{ $fourth_title }}</h5>
                        <p><a href="mailto:support@doesinfotech.com">{{ $fourth_sub_title }}</a></p>
                     </div>
                  </div>
                  <div class="media">
                     <div class="inn-cntct-icon"><i class="fa-brands fa-whatsapp"></i></div>
                     <div class="media-body">
                        <h5>{{ $fifth_title }}</h5>
                        <p><a href="tel:+916267249319">{{ $fifth_sub_title }}</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="contact_location">
         <div class="row g-4 row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-3 row-cols-xxl-3">
            @foreach ($extra_data as $val)
               @if($val->type == 7)
                  <div class="col d-flex align-items-stretch">
                     <div class="locationbox media">
                        <div class="inn-cntct-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="media-body">
                           <h5>{{ $val->title }}</h5>
                           <p>{!! $val->body !!}
                           </p>
                        </div>
                     </div>
                  </div>
               @endif
            @endforeach
         </div>
      </div>
   </div>
</section>

@endsection
@section('more-scripts')
<script>
   $(document).ready(function() {
       @if (session('success'))
           $('html, body').animate({
               scrollTop: $('#contactform').offset().top
           }, 1000);
       @endif
   });
</script>
@stop