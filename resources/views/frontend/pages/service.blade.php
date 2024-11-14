@extends('layouts.app')
@section('more-css')
<style>
@media (max-width: 410px) {
    .service-inner-body .bannerForm form .h4_p{
        font-size: 18px !important;
        color: #fff !important;
    }
}
.service-inner-body .bannerForm form .h4_p{
    text-transform: uppercase;
    font-size: 24px;
    font-weight: 700;
    color: #fff !important;
    margin: 0 0 15px;
}
.service-inner-body .bannerForm form .h4_p strong {
    font-weight: 700;
    color: #1582bd;
}
.about-area-two-contain h2 {
    color: #000000;
    font-weight: 700;
    font-size: 29px;
    margin: 0 0 10px;
    text-transform: uppercase;
    line-height: 38px;
}
.first_color{
    color:#00003a !important;
}
.second_color{
    color: #ffc145 !important;
}
.fz-35{
    font-size: 35px;
    
}
.about-area-two-contain span{
    color: #ffc145 !important;
}
.headingbox h2:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -20px;
    width: 157px;
    height: 2px;
    background: #033355;
    right: 0;
    margin: auto;
}
.headingbox h2:before {
    content: "";
    position: absolute;
    left: 0;
    bottom: -26px;
    width: 90px;
    height: 2px;
    background: #033355;
    right: 0;
    margin: auto;
}
.headingbox h2 {
    font-size: 34px;
    color: #fff;
    text-transform: uppercase;
    margin-bottom: 40px;
    font-weight: 700;
    color: #033355;
    position: relative;
}
.headingbox h2 strong {
    color: #ffc145;
    font-weight: 700;
}
.ourservice .headingbox h2 {
    color: #f7cf1e;
    font-size: 35px;
    text-transform: uppercase;
}
.professional .headingbox h2 strong {
    font-weight: 700;
    color: #ffc145;
}
.first_color{
    color:#00003a !important;
}
h2.bottom_line:before, h2.bottom_line:after{
    display:none;
}
.professional .headingbox h2, .faqbg .headingbox h2, .ourwork .headingbox h2, .tooluse .headingbox h2 {
    color: #fff;
}
.faqbg .headingbox h2::before, .faqbg .headingbox h2::after, .ourwork .headingbox h2::before, .ourwork .headingbox h2::after, .tooluse .headingbox h2::before, .tooluse .headingbox h2::after {
    background: #fff;
} 
 @media(max-width:767px){
     .about-area-two-contain h2{
         font-size: 18px;
         line-height: 26px;
     }
     .service-inner-banner .banner-textbox .titlebox-banner {
        max-width: 100%;
        /* margin-left: auto; */
         margin-right:0px !important; 
        text-align: center;
    }
    .titlebox-banner h1:nth-child(1){
        color:#fff !important;
        font-size: 30px !important;
        font-weight: 700;
    }
    .titlebox-banner h1:nth-child(2){
        color:#facc15 !important;
        font-size: 23px!important;
        font-weight: 600;
    }
 }
 @media(max-width:410px){
     .helpyou-body .nav .nav-link{
         width: 18% !important;
     }
     .service-inner-banner .banner-textbox .titlebox-banner {
        max-width: 100%;
        /* margin-left: auto; */
         margin-right:0px !important; 
        text-align: center;
    }
    .titlebox-banner h1:nth-child(1){
        color:#fff !important;
        font-size: 30px!important;
        font-weight: 700;
    }
    .titlebox-banner h1:nth-child(2){
        color:#facc15 !important;
        font-size: 23px!important;
        font-weight: 600;
    }
 } 
.titlebox-banner h1:nth-child(1){
    color:#fff !important;
    font-size: 70px;
    font-weight: 700;
}
.titlebox-banner h1:nth-child(2){
    color:#facc15 !important;
    font-size: 48px;
    font-weight: 600;
}
.service-inner-banner .banner-textbox{
    width: 70% ;
    top: 50%;
}
</style>
<style>
.h1_new{
    font-size:70px;
    font-weight:700;
}
.placement{
    width: 80%;
    top: 50%;
    -webkit-transform: translate(0, -50%);
    left: 10%;
    transform: translate(0, -50%);
}
@media(max-width:767px){
    .h1_new{
        font-size:30px;
    }
    .placement{
        width: 80%;
        top: 31%;
        -webkit-transform: translate(0, -50%);
        left: 10%;
        transform: translate(0, -50%);
    }
    .headingbox h2{
        font-size:19px !important;
    }
    .bg_acc_new .span  {
        background: #033355;
        padding: 0 10px;
        border-radius: 10px;
    }
    .innerbanner-area .breadcrumb-item.active {
        color: #ffc145 !important;
        font-weight: 500;
    }
} 
.bg_acc_new h2 strong, .bg_acc_new h3 strong{
    background: #033355;
    padding: 0 10px;
    border-radius: 10px;
}
.innerbanner-area .breadcrumb-item.active {
    color: #032140;
    font-weight: 500;
}
.dropdown.packages h5 span{
        color: #ff0000 !important;
}
</style>
@endsection
@section('content')
@foreach ($extra_data as $val) 

    @php $page_id = $val->page_id; @endphp

    @switch($val->type)
        @case(1)
            @php $image = $val->image;
            $first_body = $val->body;
            @endphp

            @break
        @case(2)
            @php
                $title = $val->title;
                $btn_text = $val->btn_text;
            @endphp
            @break
        @case(3)
            @php
                $second_title = $val->title;
                $second_image = $val->image;
                $body = $val->body;
            @endphp
            @break
        @case(4)
            @php $third_title = $val->title; @endphp
            @break
        @case(6) 
            @php $fourth_title = $val->title; @endphp
            @break
        @case(8)
            @php
                $fifth_title = $val->title;
                $fifth_body = $val->body;
            @endphp
            @break
        @case(10)
            @php
                $sixth_title = $val->title;
                $sub_title = $val->sub_title;
            @endphp
            @break
        @case(12)
            @php
                $seventh_title = $val->title;
                $seventh_body = $val->body;
            @endphp
            @break
        @case(14)
            @php $eighth_title = $val->title; @endphp
            @break
        @case(16)
            @php $ninth_title = $val->title; @endphp
            @break
        @case(18)
            @php $third_image = $val->image; @endphp
            @break 
        @case(20)
            @php $tenth_title = $val->title; @endphp
            @break
        @case(23)
            @php
                $eleven_title = $val->title;
                $eleven_body = $val->body;
                $eleven_btn_text = $val->btn_text;
                $eleven_btn_url = $val->btn_url;
            @endphp
            @break
        @case(24)
            @php $twenty_four_title = $val->title; @endphp
            @break
        @case(25)
            @php
                $twenty_five_btn_text = $val->btn_text;
                $twenty_five_btn_url = $val->btn_url;
            @endphp
            @break
        @case(26)
            @php $fourteen_title = $val->title; @endphp
            @break
        @case(28)
            @php $twenty_eight_title = $val->title; @endphp
            @break
        @case(30)
            @php $thirty_title = $val->title; @endphp
            @break
        @case(33)
            @php $thirty_three_title = $val->title; @endphp
            @break
        @case(34)
            @php $thirty_four_title = $val->title; @endphp
            @php $thirty_four_sub_title = $val->sub_title; @endphp
            @php $thirty_four_btn_text = $val->btn_text; @endphp
            @php $thirty_four_btn_url = $val->btn_url; @endphp
            @php $thirty_four_body = $val->body; @endphp
            @break
        @case(36)
            @php $thirty_six_title = $val->title; @endphp
            @php $thirty_six_sub_title = $val->sub_title; @endphp
            @php $thirty_six_btn_text = $val->btn_text; @endphp
            @php $thirty_six_btn_url = $val->btn_url; @endphp
            @php $thirty_six_body = $val->body; @endphp
            @break
        @case(38)
            @php $thirty_eight_title = $val->title; @endphp
            @php $thirty_eight_sub_title = $val->sub_title; @endphp
            @php $thirty_eight_btn_text = $val->btn_text; @endphp
            @php $thirty_eight_btn_url = $val->btn_url; @endphp
            @php $thirty_eight_body = $val->body; @endphp
            @break
        @case(40)
            @php $fourty_title = $val->title; @endphp
            @php $fourty_sub_title = $val->sub_title; @endphp
            @php $fourty_btn_text = $val->btn_text; @endphp
            @php $fourty_btn_url = $val->btn_url; @endphp
            @php $fourty_body = $val->body; @endphp
            @break
         
    @endswitch
@endforeach
@php
 $phoneNumber = config('site.whatsapp'); 

$newPhoneNumber = str_replace(['+', '-'], '', $phoneNumber);

$encodedPhoneNumber = urlencode($newPhoneNumber);
@endphp
  
    <!--<div id="bannerContainer"></div>-->
    
@include('frontend.form.slider_form')

  <section class="about-area-two"> 
    <div class="innerbanner-area">
      <nav class="breadcrumb bg_acc_new">
        <div class="container">
            <a class="breadcrumb-item fw-bold" href="{{url('/')}}">home</a>
            <span class="breadcrumb-item active">
              <span class="span">{{ $page->page_name}}</span>
            </span>
        </div>
      </nav>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5">
          <figure class="about-area-two-img">
            @if (file_exists(public_img_path($second_image)))
            <img src="{{ asset('uploads/' . $second_image) }}" alt="{{ getImageNameAlt($second_image) }}">
            
            @else
                Image not found
            @endif
          </figure>
        </div>
        <div class="col-lg-7 col-md-7">
          <div class="about-area-two-contain">
            <h2>{!! $second_title !!}</h2>
            {!! $body !!}
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="service bg_acc_new">
    <div class="container">
        <div class="headingbox">
            <h2 class="text-center">{!! $third_title !!}</h2>
        </div>
      <div class="row">
        @foreach ($extra_data as $val)
          @if($val->type ==5 )
          <div class="col-lg-4 col-md-6 col-sm-6 seoarea d-flex align-items-stretch">
            <div class="seobox">
              <div class="seoicon"><img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}"></div>
              <div class="seobox_h4">{{ $val->title }}</div>
                {!! $val->body !!}
              <div class="d-flex align-items-center justify-content-center seoboxfooter">
                <button class="btn-info" onclick="window.location.href = '{{ $val->btn_url }}'" type="button">{{ $val->btn_text }}</button>
                <button class="btn-Chat" onclick="window.location.href = 'https://wa.me/{{ $encodedPhoneNumber }}?text=Hi'" type="button"><i class="fa-brands fa-whatsapp"></i>Chat With Us</button>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>

  <div class="professional" style="background:url({{ asset('frontend/images/professionalbg.webp') }}) center no-repeat fixed">
    <div class="container">
      <div class="headingbox text-center">
        <h2>{!! $fourth_title !!}</h2>
      </div>
      <!--  -->
      <div class="professional-tab-area">
        <nav class="nav nav-tabs" id="nav-tab2" role="tablist">
          @php $countNum = 0; @endphp
          @foreach ($extra_data as $key=>$value)
            @if($value->type ==7 )
            @php $countNum++; @endphp
              <a class="nav-link d-flex align-items-center justify-content-center {{ $countNum ==1 ? 'active' : '' }}"  data-bs-toggle="tab" href="#professional-{{ $key }}" >
                <div class="w-100">
                  <img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}">
                  <div class="w-100">{{ $value->title }}</div>
                </div>
              </a>
            @endif
          @endforeach
        </nav>
        <div class="tab-content" id="nav-tabContent2">
          @php $count = 0; @endphp
          @foreach ($extra_data as $key => $value)
          @if ($value->type == 7)
          @php $count++; @endphp
              <div class="tab-pane fade {{ $count == 1 ? 'show active' : '' }}" id="professional-{{ $key }}" role="tabpanel">
                <div class="tab-panel-box">
                  <div class="heading">
                    <h3>{{ $value->title }}</h3>
                  </div>
                  <div class="body-area">
                    {!! $value->body !!}
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="helpyou pt-3 bg_acc_new">
    <div class="container">
      <div class="headingbox text-center">
        <h2>{!! $fifth_title !!}</h2>
        {!! $fifth_body !!}
      </div>
      <div class="helpyou-body">
        <nav class="nav nav-tabs justify-content-center" id="nav-tab1" role="tablist">
          @php $countData = 0; @endphp
          @foreach ($extra_data as $key => $value)
            @if ($value->type == 9)
            @php $countData++;
            @endphp
              <a class="nav-link {{ $countData == 1 ? 'active' : '' }}"  data-bs-toggle="tab" href="#SERVICES{{ $key }}" role="tab">
                <img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}">
              </a>
            @endif
          @endforeach
        </nav>
        <div class="tab-content" id="nav-tabContent1">
          @php $count_num = 0 ; @endphp
          @foreach ($extra_data as $key => $value)
             @if ($value->type == 9)
             @php $count_num++ ;
             @endphp
              <div class="tab-pane fade {{ $count_num==1 ? 'show active' : '' }}" id="SERVICES{{ $key }}" role="tabpanel">
                <div class="row">
                  <div class="col-lg-5 col-md-5 order-md-2">
                    <figure class="marketingImg">
                      <img src="{{ asset('uploads/'.$value->image2) }}" alt="{{ getImageNameAlt($value->image2) }}">
                    </figure>
                  </div>
                  <div class="col-lg-7 col-md-7 order-md-1">
                    <div class="marketing-contain">
                      <h2>{{ $value->title }}</h2>
                      {!! $value->body !!}
                      <a href="{{ $value->btn_url }}" class="btn-primary">{{ $value->btn_text }}</a>
                    </div>
                  </div>
                </div>
              </div>
             @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="tooluse">
    <div class="container">
      <div class="headingbox text-center">
        <h2>{!! $sixth_title !!}</h2>
      </div>
      <div class="tooluse_h5">{!! $sub_title !!}</div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xxl-3">
        @foreach ($extra_data as $key => $value)
          @if ($value->type == 11)
            <div class="col d-flex align-items-stretch">
              <div class="card about-service-box">
                <div class="card-body d-flex align-items-center justify-content-center">
                  <div class="w-100 text-center">
                    <figure class="icon"><img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}"></figure>
                    <div class="about-service-box_h4">{{ $value->title }}</div>
                    {!! $value->body !!}
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
<!--tools we use-->
<div class="whyus tools-area bg_acc_new" style="padding-bottom: 50px !important;" >
     @include('frontend.fix-widgets.tools_we_use')
</div>
<!--tools we use-->
  
  <div class="talk-numbers-area rahul bg_acc_new">
    <div class="container">
      <div class="headingbox text-center">
        <h2>{!! $our_strength[6]->title !!}</h2>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 order-md-2">
          <figure class="talk-numbers-imgbox">
            <img src="{{ asset('uploads/'.$third_image) }}" alt="{{ getImageNameAlt($third_image) }}">
          </figure>
        </div> 
        
        <div class="col-lg-3 col-md-3 d-flex align-items-center order-md-1">
          <div class="talk-numbers-main-box w-100">
            @foreach ($our_strength as $value)
              @if(in_array($value->id, [1, 2, 3]))
                <div class="talk-numbers-box">
                  <img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}">
                  <div class="second_h4">{{ $value->title }}</div>
                  <p>{{ $value->sub_title }}</p>
                </div>
              @endif
            @endforeach
          </div> 
        </div>


        <div class="col-lg-3 col-md-3 d-flex align-items-center order-md-3">
          <div class="talk-numbers-main-box w-100">
            @foreach ($our_strength as $key => $value)
                  @if (in_array($value->id, [4, 5, 6]))
                    <div class="talk-numbers-box">
                      <img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}">
                      <div class="second_h4">{{ $value->title }}</div>
                      <p>{{ $value->sub_title }}</p>
                    </div>
                  @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  
<!------------our partners------------>
@include('frontend.fix-widgets.our_partners_other_page')
<!------------our partners------------>

  <div class="portfoliosection bg_acc_new">
    <div class="container">
       <div class="headingbox text-center">
          <h2>@if(!empty($eleven_title)) {!! $eleven_title !!}@endif</h2>
       </div>
       <div id="toolcarousel" class="owl-carousel portfolio-carousel">
        @foreach ($seo_results as $key=>$val)
          <div class="card seoLandingBox">
             <div class="card-img d-flex"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"></div>
             <div class="card-body">
                  <div class="slider_h4">{{ $val->page_title }}</div>
                  {!! $val->body !!}
                <div class="d-flex align-items-center seoLandingBoxCountry">
                   <div class="flex-shrink-0  media-img">
                    <img src="{{ asset('uploads/'.$val->bannerimage) }}" alt="{{ getImageNameAlt($val->bannerimage) }}">
                   </div>
                    <div class="flex-grow-1 media-body">
                        <div class="flex-grow-1_h5">{{ $val->bannertext }}</div>
                    </div>
                </div>
             </div>
             <div class="card-footer">
                <div class="searchPercent d-flex align-items-center justify-content-center">
                    <div class="percen_h5">{!! $val->author_url !!}</div>
                </div>
               <button class="btn-read" onclick="window.location.href = '{{ url('seo-result/'.$val->slug) }}'" type="button">View</button>
             </div>
          </div>
          @endforeach
       </div>
       <div class="text-center">
          <a href="@if(!empty($eleven_btn_url)) {!! $eleven_btn_url !!}@endif" class="btn-primary">@if(!empty($eleven_btn_text)) {!! $eleven_btn_text !!}@endif</a>
       </div>
    </div>
 </div>
 <!-------------price widget---------> 
 @if(!empty($data_new) && !empty($data1) && !empty($data2) && !empty($data3))
  <div class="packages-area"> 
        @include('frontend.inc.price_card')   
 </div> 
 @endif
<!-------------price widget--------->
<!-------------query from --------->
<?php // echo "<pre>";print_r($page->parent_id);?>

@if($page->parent_id != 33 && $page->service_order != 1) 
<div class="bring">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 pr-100">
            <div class="headingbox">
              <h3>{!! $query_from->title !!}</h3>
            </div> 
              {!! $query_from->body !!} 
          </div>
          <div class="col-lg-5">
            <div class="frombox">
              <form method="post" action="{{ url('home-form') }}" class="servicePage" id=" " autocomplete="off">
                @csrf
                @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                @endif
                <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
                <input type="hidden" name="form_identity" class="form-control" value="body_form">
                <input type="hidden" name="number_new" class="form-control number_new" value="">
                <input type="hidden" name="country_code" class="form-control country_code" value="">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Name*"  >
                      @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-lg-6">
                    <div class="form-group">
                         <!--id="mobile_code"-->
                      <input type="number" class="form-control mobile_code" id="mobile_code_new"   name="phone" placeholder="Phone"  >
                      @if ($errors->has('phone'))
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                 
                  <div class="col-lg-6">
                    <div class="form-group">
                        <select class="form-control" id="serviceName" name="serviceName">
                            <option>Select Service</option>
                            @foreach ($allServiceData as $key=>$value)
                              <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                            @endforeach
                        </select>
                      @if ($errors->has('serviceName'))
                      <span class="text-danger">{{ $errors->first('serviceName') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="budget" placeholder="Budget">
                      @if ($errors->has('budget'))
                      <span class="text-danger">{{ $errors->first('budget') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                       <input type="text" class="form-control" name="website_url" placeholder="Website Url">
                      @if ($errors->has('website_url'))
                      <span class="text-danger">{{ $errors->first('website_url') }}</span>
                      @endif
                    </div>
                  </div>

                    <div class="captcha">
                        <div id="discreetPuzzle1"></div>
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @elseif ($errors->has('recaptcha_validate'))
                            <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                        @endif
                    </div>
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">{{ $query_from->btn_text }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endif
<!-------------query from ---------> 
 <!---------our work -------->
 @include('frontend.fix-widgets.ourwork')
 <!---------our work -------->
 
  <div class="review bg_acc_new">
    <div class="container">
       <div class="headingbox text-center ">
          <h2>@if(!empty($twenty_eight_title)) {!! $twenty_eight_title !!}@endif</h2>
       </div>
       <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>
        @foreach ($extra_data as $val)
            @if($val->type == 29 )
            <div class="col-lg-3 col-md-6 col-sm-6 cordbox">
                <div class="review-box card">
                <div class="card-img">
                    @if(!empty($val->image))
                        @if (file_exists(public_img_path($val->image)))
                        <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                        @else Image not found @endif
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-icon">
                    @if(!empty($val->image))
                        @if (file_exists(public_img_path($val->image)))
                        <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                        @else Image not found @endif
                    @endif
                    </div>
                    <div class="Review_h4">{{ $val->title }}</div>
                    <ul>
                    @for ($i= 0; $i < $val->sub_title ; $i++)
                    <li><i class="fa-solid fa-star"></i></li>
                    @endfor
                    </ul>
                    {!! $val->body !!}
                    <div class="rfacebook text-center">
                        @if(!empty($val->image2))
                            @if (file_exists(public_img_path($val->image2)))
                            <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                            @else Image not found @endif
                        @endif
                    </div>
                </div>
                </div>
            </div>
            @endif
        @endforeach
       </div>
    </div>
 </div>

  <section class="faqbg" style="background:url({{ asset('frontend/images/faqbg.webp') }}) center no-repeat fixed;">
    <div class="container">
      <div class="headingbox text-center ">
        <h2>@if(!empty($thirty_title)) {!! $thirty_title !!}@endif</h2>
      </div>
    </div>
  </section>
  <section class="faqarea">
    <div class="container">
       <div class="row">
          <div class="col-lg-6">
             <div class="accordion" id="accordionExample">
                @foreach ($extra_data as $key=>$faq)
                  @if($faq->type == 31 )
                    <div class="accordion-item">
                      <div class="accordion-header" id="headingOne{{$key}}">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne{{ $key }}">{{ $faq->title }}</button>
                      </div>
                      <div id="collapseOne{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            {!! $faq->body !!}
                          </div>
                      </div>
                    </div>
                  @endif
                @endforeach
             </div>
          </div>
          <div class="col-lg-6">
             <div class="accordion" id="accordionExample1">
                @foreach ($extra_data as $key=>$faq)
                    @if($faq->type == 32 )
                      <div class="accordion-item">
                        <div class="accordion-header" id="heading{{ $key }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">{{ $faq->title }}</button>
                        </div>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample1">
                            <div class="accordion-body">
                              {!! $faq->body !!}
                            </div>
                        </div>
                      </div>
                    @endif
                @endforeach
             </div>
          </div>
       </div>
    </div>
 </section>

 @if ($blogData->isNotEmpty())
 <div class="blog bg_acc_new">
  <div class="container">
    <div class="headingbox text-center ">
      <h2>{!! $thirty_three_title !!}</h2>
    </div>
    <div class="row">
      @foreach ($blogData as $key=>$val)
      <div class="col-lg-4 col-md-6">
        <div class="bolgbox">
          <div class="bolimg"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
            <div class="btxt">
              <div class="bicon"><img src="{{ asset('uploads/'.$val->author_image) }}" alt="{{ getImageNameAlt($val->author_image) }}"></div>
              <div class="stxt">
                <div style="font-size: 14px; margin-bottom: 5px; color: #191919; font-weight: 600;">{{ $val->page_title }}</div>
                <div style="font-size: 11px; font-weight: 500;">{{ $val->bannertext }}</div>
              </div>
            </div>
          </div>
          <div class="boltxt">
              <div class="boltxt_h4">
                  @if(!empty($val->redirect_to))
                    <a href="{{ url($val->redirect_to) }}">{{ $val->page_name }}</a>
                    @else
                    <a href="{{ url('blog/'.$val->slug) }}">{{ $val->page_name }}</a>
                  @endif
              </div>
              @php
              $text = $val->body;
              $limitedContent = substr($text, 0, 150);
              @endphp
             @if($limitedContent){!! $limitedContent.'...' !!}@else {!! $limitedContent !!} @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif

@endsection
@section('more-scripts')

<script>
$(document).ready(function() {
    
    loadBanner();
    
    $('.new_click_new').on('click', function() {  
        // Get the ID of the clicked tab
        var tabId = $(this).attr('href'); 
        // Hide all tab panes except the one clicked
        $('.price_card_figma .tab-pane').not(tabId).removeClass('show active').addClass('hide display_none');
        
        // Show the clicked tab pane
        $(tabId).addClass('show active').removeClass('hide display_none');
    });
    
    
    function loadBanner() {
        var width = $(window).width();
        var bannerContainer = $('#bannerContainer');
        
        if (width > 997) {
          $.get('{{ route('partials.desktop-banner') }}', function(html) { 
            bannerContainer.html(html);
          });
        } else {
          $.get('{{ route('partials.mobile-banner') }}', function(html) {
            bannerContainer.html(html);
          });
        }
      }

      

      $(window).resize(loadBanner);
      
     $(".servicePage").on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting initially
        let isValid = true;

        // Clear previous error messages
        $(".text-danger").remove();

        // Validate name
        let name = $('#name').val();
        if (!name || name.trim() === '') {
            $('#name').after('<span class="text-danger">Name is required</span>');
            isValid = false;
        }

        // Validate phone
        let phone = $('#mobile_code_new').val();
        // Check if phone is 10 digits and numeric
        if (!phone || phone.length !== 10 || isNaN(phone)) {
            $('#mobile_code_new').after('<span class="text-danger">Enter a valid 10-digit mobile number</span>');
            isValid = false;
        }

        // Validate service name
        let serviceName = $('#serviceName').val();
        if (!serviceName || serviceName === 'Select Service') {
            $('#serviceName').after('<span class="text-danger">Service name is required</span>');
            isValid = false;
        }

        // Debugging
        console.log("Is form valid?", isValid);
        console.log("Name:", name);
        console.log("Phone:", phone);
        console.log("Service Name:", serviceName);

        // If the form is valid, submit it
        if (isValid) {
            console.log("Submitting form...");
            this.submit(); // This will now submit the form
        } else {
            console.log("Form is invalid. Not submitting.");
        }
    });
    $("input").on('input', function() {
        $(this).next('.text-danger').remove();
    });

    // Remove error message on select change
    $("select").on('change', function() {
        $(this).next('.text-danger').remove();
    });
}); 
</script> 
@stop
