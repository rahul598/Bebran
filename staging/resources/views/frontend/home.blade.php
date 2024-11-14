@extends('layouts.app')
@section('more-css')
<style> 
.banner .banner-textbox { 
    top: 85% !important; 
}

@media(max-width:767px){
    .banner .banner-textbox {  
        top: 90% !important;
        left: 3% !important;    
    }
    .banner .banner-textbox h1 strong{
        font-size: 30px;
    }
    .home_slider_banner{
        height:50%;
    }
}

@media(max-width:480px){
    .banner .banner-textbox {  
        top: 90% !important;
        left: 3% !important;    
    }
    .banner .banner-textbox h1 strong{
        font-size: 24px !important;
    }
    .home_slider_banner{
        height:50%;
    }
}
/********h2 style********/
.seoclientsay-area .headingbox h2 {
    color: #ffffff;
}
.faqbg .headingbox h2:before, .faqbg .headingbox h2:after, .tooluse .headingbox h2:before, .tooluse .headingbox h2:after, .professional .headingbox h2:before, .professional .headingbox h2:after, .strength .headingbox h2:before, .strength .headingbox h2:after,  .seoclientsay-area .headingbox h2:before, .seoclientsay-area .headingbox h2:after {
    background-color: #ffffff;
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
.faqbg .headingbox h2, .seoclientsay-area .headingbox h2, .tooluse .headingbox h2, .professional .headingbox h2, .strength .headingbox h2 {
    color: #fff;
}
.danger_text{
    font-size:12px ;
}
.low_height{
    height:auto;
}
</style>
@endsection
@section('content')

@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp
    @switch($val->type)
        @case(1)
            @php
            $image = $val->image;
            $first_body = $val->body;
            @endphp
            @break
        @case(2)
            @php
                $title = $val->title;
                $sub_title = $val->sub_title;
                $body = $val->body;
                $btn_text = $val->btn_text;
                $btn_url = $val->btn_url;
                $image_one = $val->image;
            @endphp
            @break
        @case(3)
            @php $second_title = $val->title; @endphp
            @break
        @case(5)
            @php
                $third_title = $val->title;
                $third_body = $val->body;
            @endphp
            @break
        @case(7)
            @php
                $fourth_title = $val->title;
                $fourth_body = $val->body;
            @endphp
            @break
        @case(9)
            @php
                $fifth_title = $val->title;
                $fifth_image = $val->image;
                $fifth_image2 = $val->image2;
                $fifth_body = $val->body;
                $fifth_subtitle = $val->sub_title;
            @endphp
            @break
        @case(10)
            @php
                $sixth_title = $val->title;
                $sixth_image = $val->image;
                $sixth_image2 = $val->image2;
                $sixth_body = $val->body;
            @endphp
            @break
        @case(11)
            @php
                $seventh_title = $val->title;
                $seventh_body = $val->body;
            @endphp
            @break
        @case(13)
            @php $eighth_title = $val->title; @endphp
            @break
        @case(14)
            @php
                $ninth_title = $val->title;
                $ninth_image = $val->image;
                $ninth_image2 = $val->image2;
                $ninth_body = $val->body;
                $ninth_sub_title = $val->sub_title;
            @endphp
            @break
        @case(15)
            @php
                $tenth_title = $val->title;
                $tenth_image = $val->image;
                $tenth_image2 = $val->image2;
                $tenth_body = $val->body;
                $tenth_sub_title = $val->sub_title;
            @endphp
            @break
        @case(16)
            @php $eleven_title = $val->title; @endphp
            @break
        @case(18)
            @php
                $twelve_title = $val->title;
                $twelve_body = $val->body;
                $twelve_btn_text = $val->btn_text;
                $twelve_btn_url = $val->btn_url;
            @endphp
            @break
        @case(19)
            @php $thirteen_title = $val->title; @endphp
            @break
        @case(21)
            @php $fourteen_title = $val->title; @endphp
            @break
        @case(23)
            @php 
            $fifteen_title = $val->title; 
            $fifteen_btn_text = $val->btn_text; 
            $fifteen_btn_url = $val->btn_url; 
            
            @endphp
            @break
        @case(24)
            @php 
            $twenty_four_title = $val->title; 
            @endphp
            @break
        @case(26)
            @php $twenty_six_title = $val->title; @endphp
            @break
        @case(27)
            @php $seventeen_title = $val->title; @endphp
            @break
        @case(28)
            @php $twenty_eight_title = $val->title; @endphp
            @break
        @case(29)
            @php $twenty_nine_title = $val->title; @endphp
            @break
    @endswitch
@endforeach
@php
 $phoneNumber = config('site.whatsapp'); 

$newPhoneNumber = str_replace(['+', '-'], '', $phoneNumber);

$encodedPhoneNumber = urlencode($newPhoneNumber);
@endphp
    <div class="banner-area">
      <!--<div class="owl-carousel banner-carousel" id="banner-slider">-->
      <div  >
        <div class="banner d-flex align-items-center"> 
        <img src="{{ asset('uploads/'.$image) }}"  srcset="{{ asset('uploads/'.$image) }} 1519w" sizes="(max-width: 600px) 100vw, 1519px" alt="{{ getImageNameAlt($image) }}" width="1519" height="596" class="home_slider_banner"> 

          <div class="banner-textbox">
            <div class="container">
              <div class="titlebox-banner">
                @if(!empty($first_body))
                {!! $first_body !!}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="about-area pt-90 low_height" id="about" >
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xxl-6 col-lg-6 col-md-6">
        <div class="webtext">
          <h2>{!! $title !!} {!! $sub_title !!}</h2>
          {!! $body !!}
          <a href="{{ $btn_url }}" class="btn-primary">{{ $btn_text }}</a> 
        </div>
      </div>
      <div class="col-xxl-6 col-lg-6 col-md-6">
        <div class="about-imgbox">
          <img src="{{ asset('uploads/'.$image_one) }}" 
               alt="{{ getImageNameAlt($image_one) }}" 
               width="606" 
               height="516" 
               loading="lazy" 
               style="max-width: 100%; height: auto;">
        </div>
      </div>
    </div>
  </div>
</section>

    
    <!------------- Our Strength-------------->
    @include('frontend.fix-widgets.our_strength')
    <!------------- Our Strength-------------->
    
    <div class="service">
      <div class="container">
        <div class="headingbox text-center">
          <h2>{!! $third_title !!}</h2>
          {!! $third_body !!}
        </div>
        <div class="row">
          @foreach ($extra_data as $val)
            @if($val->type == 6 )
              <div class="col-lg-4 col-md-6 col-sm-6 seoarea d-flex align-items-stretch">
                <div class="seobox">
                  <div class="seoicon"><img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="74" height="74"></div>
                  <h4>{{ $val->title }}</h4>
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
    
    <!-------------certificated_digital ------------------>
    @include('frontend.fix-widgets.certificated_digital')
    <!--------------certificated_digital ------------------>
    
    <div class="helpyou">
      <div class="container">
        <div class="headingbox text-center">
          <h2>{!! $fifth_title !!}</h2>
        </div>
        <div class="helpyouarea">
          <div class="Whatwedo_box row">
            <div class="col-lg-6 col-md-6 Whatwedoimg d-flex flex-wrap align-content-stretch">
              <div class="Whatwedo_thumble d-flex"> <img src="{{ asset('uploads/'.$fifth_image) }}" alt="{{ getImageNameAlt($fifth_image) }}" width="606" height="400">
                <div class="helpicon"><img src="{{ asset('uploads/'.$fifth_image2) }}" alt="{{ getImageNameAlt($fifth_image2) }}" ></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 Whatwedocontent d-flex flex-wrap align-content-stretch align-items-center">
              <div class="Whatwedo_textbox">
                <h3>{!! $fifth_subtitle !!}</h3>
                {!! $fifth_body !!}
              </div>
            </div>
          </div>
          <div class="Whatwedo_box row">
            <div class="col-lg-6 col-md-6 Whatwedoimg d-flex flex-wrap align-content-stretch">
              <div class="Whatwedo_thumble d-flex"> <img src="{{ asset('uploads/'.$sixth_image) }}" alt="{{ getImageNameAlt($sixth_image) }}" width="606" height="400">
                <div class="helpicon"><img src="{{ asset('uploads/'.$sixth_image2) }}" alt="{{ getImageNameAlt($sixth_image2) }}" ></div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 Whatwedocontent d-flex flex-wrap align-content-stretch align-items-center">
              <div class="Whatwedo_textbox">
                <h3>{!! $sixth_title !!}</h3>
               {!! $sixth_body !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--------------tools we use ------------------>
    @include('frontend.fix-widgets.tools_we_use')
    <!--------------tools we use ------------------>
    <div class="whyus">
      <div class="container">
        <div class="headingbox text-center">
          <h2>{!! $eighth_title !!}</h2>
        </div>
        <div class="row wus">
          <div class="col-lg-6 digimg p-0">
            <div class="whyimg"><img src="{{ asset('uploads/'.$ninth_image) }}" alt="{{ getImageNameAlt($ninth_image) }}"></div>
          </div>
          <div class="col-lg-6 digitxt p-0">
            <div class="whyr" style="background:url({{ asset('uploads/'.$ninth_image2) }}) center no-repeat">

              <h6>Professional </h6><h4> Digital Marketing</h4><h5>Firm</h5>

              {{-- <h4>{!! $ninth_title !!} {!! $ninth_sub_title !!}</h4> --}}
              {!! $ninth_body !!}
            </div>
          </div>
        </div>
        <div class="row us">
          <div class="col-lg-6 p-0 digitxt">
            <div class="whyle" style="background:url({{ asset('uploads/'.$tenth_image2) }}) center no-repeat">
              <h6>{!! $tenth_title !!}</h6><h4>marketing</h4><h5>consultants</h5>
              {{-- <h4>{!! $tenth_title !!} {!! $tenth_sub_title !!}</h4> --}}

              {{-- <h4><span >Digital</span><br> Marketing <span class="first_title"><br>Consultants</span></h4> --}}
              {!! $tenth_body !!}
            </div>
          </div>
          <div class="col-lg-6 digimg p-0">
            <div class="whyimg1"><img src="{{ asset('uploads/'.$tenth_image) }}" alt="{{ getImageNameAlt($tenth_image) }}"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-------------our_partners ------------------>
    @include('frontend.fix-widgets.our_partners')
    <!-------------our_partners ------------------>
    
    <div class="bring">
      <div class="container">
        <div class="row">
            <div class="col-lg-7 pr-100">
                <div class="headingbox">
                  <h3>{!! $twelve_title !!}</h3>
                </div> 
                  {!! $twelve_body !!} 
            </div>
          <div class="col-lg-5">
            <div class="frombox">
              <form method="post" action="{{ url('home-form') }}" id="homeForm" autocomplete="off">
    @csrf
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
    <input type="hidden" name="form_identity" class="form-control" value="body_form">
    <input type="hidden" name="number_new" class="form-control number_new" value="">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name*"  >
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="form-group">
                <input type="number" class="form-control mobile_code" id="mobile_code" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" name="phone" placeholder="Phone"  value="">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
        </div>
       
        <div class="col-lg-6">
            <div class="form-group">
                <select class="form-control" name="serviceName"  >
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
                <input type="text" class="form-control" name="budget" placeholder="Budget"  >
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
            <div id="html_element"></div>
            @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
            @elseif ($errors->has('recaptcha_validate'))
                <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
            @endif
        </div>
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">{{ $twelve_btn_text }}</button>
        </div>
    </div>
</form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="consectetur">
      <div class="container">
        <div class="headingbox text-center ">
          <h2>{!! $thirteen_title !!}</h2>
        </div>
        <div class="nav nav-tabs" role="tablist">
          @php $countNum = 0; @endphp
          @foreach ($extra_data as $key=>$value)
            @if($value->type == 20)
              <button class="nav-link {{ $countNum == 0 ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#nav-{{ $key }}" type="button" role="tab">
                <span><img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}" class="oj_contain" width="43" height="33"></span>{{ $value->title }}
              </button>
              @php $countNum++; @endphp
            @endif
          @endforeach
        </div>
        
        <div class="tab-content" id="nav-tabContent2">
          @php $count = 0; @endphp
          @foreach ($extra_data as $key => $value)
            @if ($value->type == 20)
              <div class="tab-pane fade {{ $count == 0 ? 'show active' : '' }}" id="nav-{{ $key }}" role="tabpanel">
                <h4>{!! $value->sub_title !!}</h4>
                <div class="tab-body">
                  {!! $value->body !!}
                </div>
              </div>
              @php $count++; @endphp
            @endif
          @endforeach
        </div>
        
      </div>
    </div>
    
    <!-------------- ourwork ------------------>
    @include('frontend.fix-widgets.ourwork')
    <!-------------- ourwork ------------------>
    
    <div class="portfoliosection">
      <div class="container">
         <div class="headingbox text-center">
            <h2>@if(!empty($fifteen_title)) {!! $fifteen_title !!}@endif</h2>
         </div>
         <div id="toolcarousel" class="owl-carousel portfolio-carousel">
          @foreach ($seo_results as $key=>$val)
            <div class="card seoLandingBox">
               <div class="card-img d-flex"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"></div>
               <div class="card-body">
                    <h4>{{ $val->page_title }}</h4>
                    {!! $val->body !!}
                  <div class="d-flex align-items-center seoLandingBoxCountry">
                     <div class="flex-shrink-0  media-img">
                      <img src="{{ asset('uploads/'.$val->bannerimage) }}" alt="{{ getImageNameAlt($val->bannerimage) }}">
                     </div>
                     <div class="flex-grow-1 media-body">
                      <h5>{{ $val->bannertext }}</h5>
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <div class="searchPercent d-flex align-items-center justify-content-center">
                    <h5>{!! $val->author_url !!}</h5>
                  </div>
                  <button class="btn-read" onclick="window.location.href = '{{ url('seo-result/'.$val->slug) }}'" type="button">Read More</button>
               </div>
            </div>
            @endforeach
         </div>
         <div class="text-center">
            <a href="@if(!empty($fifteen_btn_url)) {!! $fifteen_btn_url !!}@endif" class="btn-primary">@if(!empty($fifteen_btn_text)) {!! $fifteen_btn_text !!}@endif</a>
         </div>
      </div>
    </div>
    
    
    
    <!--------------ourclient video ------------------>
    @include('frontend.fix-widgets.video_client')
    <!--------------ourclient video ------------------> 
    
    <div class="review">
      <div class="container">
        <div class="headingbox text-center ">
          <h2>{!! $twenty_six_title !!}</h2>
        </div>
        <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>

          @foreach ($extra_data as $val)
            @if($val->type == 27 )
              <div class="col-lg-3 col-md-6 col-sm-6 cordbox">
                <div class="review-box card">
                  <div class="card-img">
                    @if(!empty($val->image))
                        @if (file_exists(public_img_path($val->image)))
                        <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="290" height="234">
                        @else Image not found @endif
                    @endif
                  </div>
                  <div class="card-body">
                    <div class="card-icon">
                      @if(!empty($val->image))
                          @if (file_exists(public_img_path($val->image))) 
                          <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="82" height="82">
                          @else Image not found @endif
                      @endif
                    </div>
                    <h4>{!! $val->title !!}</h4>
                    <ul>
                      @for ($i= 0; $i < $val->sub_title ; $i++)
                      <li><i class="fa-solid fa-star"></i></li>
                      @endfor
                    </ul>
                    {!! $val->body !!}
                    <div class="rfacebook text-center">
                        @if(!empty($val->image2))
                            @if (file_exists(public_img_path($val->image2)))
                            <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}" width="162" height="70">
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
          <h2>{!! $twenty_eight_title !!}</h2>
        </div>
      </div>
    </section>

    <section class="faqarea">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="accordion" id="accordionExample">
                  @foreach ($faqData as $key=>$faq)
                    @if($faq->type == 1 )
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne{{$key}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">{{ $faq->title }}</button>
                            {{-- class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"   aria-expanded="{{ $loop->first ? 'true' : 'false' }}" --}}
                        </h2>
                        <div id="collapseOne{{ $key }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            {{-- {{ $loop->first ? 'show' : '' }} --}}
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
                  @foreach ($faqData as $key=>$faq)
                      @if($faq->type == 2 )
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading{{ $key }}">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">{{ $faq->title }}</button>
                          </h2>
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

    <div class="blog">
      <div class="container">
        <div class="headingbox text-center ">
          <h3>{!! $twenty_nine_title !!}</h3>
        </div>
        <div class="row">
          @foreach ($blogData as $key=>$val)
          <div class="col-lg-4 col-md-6">
            <div class="bolgbox">
              <div class="bolimg"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                <div class="btxt">
                  <div class="bicon"><img src="{{ asset('uploads/'.$val->author_image) }}" alt="{{ getImageNameAlt($val->author_image) }}"></div>
                  <div class="stxt">
                    <h5>{{ $val->page_title }}</h5>
                    <h6>{{ $val->bannertext }}</h6>
                  </div>
                </div>
              </div>
              <div class="boltxt">
                <h4>
                  @if(!empty($val->redirect_to))
                    <a href="{{ url($val->redirect_to) }}">{{ $val->page_name }}</a>
                    @else
                    <a href="{{ url('blog/'.$val->slug) }}">{{ $val->page_name }}</a>
                  @endif
                </h4>
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
@endsection
@section('more-scripts')
<script>
  $(document).ready(function() {
      @if (session('success'))
          $('html, body').animate({
              scrollTop: $('#homeForm').offset().top
          }, 1000);
      @endif
  });
  
  $(document).ready(function() {
    $("#homeForm").on('submit', function(event) {
        event.preventDefault();
        let isValid = true;
        let errorMessage = '';

        // Clear previous error messages
        $(".text-danger").remove();

        // Validate name
        const name = $("input[name='name']").val();
        if (!name) {
            isValid = false;
            errorMessage = 'Please provide your name.';
            $("input[name='name']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        }

        // Validate phone
        const phone = $("input[name='phone']").val();
        if (!phone) {
            isValid = false;
            errorMessage = 'Please provide your phone number.';
            $("input[name='phone']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        } else if (phone.length !== 10) {
            isValid = false;
            errorMessage = 'Your phone number must be exactly 10 digits long.';
            $("input[name='phone']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        }

        // Validate service name
        const serviceName = $("select[name='serviceName']").val();
        if (!serviceName || serviceName === 'Select Service') {
            isValid = false;
            errorMessage = 'Please select a service.';
            $("select[name='serviceName']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        }

        // Validate budget
        const budget = $("input[name='budget']").val();
        if (!budget) {
            isValid = false;
            errorMessage = 'Please provide your budget.';
            $("input[name='budget']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        } else if (isNaN(budget)) {
            isValid = false;
            errorMessage = 'Please enter a valid number.';
            $("input[name='budget']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        }

        // Validate website URL
        const websiteUrl = $("input[name='website_url']").val();
        const urlPattern = /^(ftp|http|https):\/\/[^ "]+$/;
        if (websiteUrl && !urlPattern.test(websiteUrl)) {
            isValid = false;
            errorMessage = 'Please enter a valid URL.';
            $("input[name='website_url']").after('<span class="danger_text text-danger">' + errorMessage + '</span>');
        }

        // Validate captcha
        if (typeof grecaptcha !== 'undefined') {
            const recaptchaResponse = grecaptcha.getResponse();
            if (!recaptchaResponse) {
                isValid = false;
                errorMessage = 'Please complete the captcha.';
                $(".captcha").append('<span class="danger_text text-danger">' + errorMessage + '</span>');
            }
        }

        // If the form is valid, submit it
        if (isValid) {
            this.submit();
        }
    });
    
    $("input").on('input', function() {
        $(this).next('.text-danger').remove();
    });

    // Remove error message on select change
    $("select").on('change', function() {
        $(this).next('.text-danger').remove();
    });
    
    var code = $('.iti__selected-dial-code').text(); 
    console.log(code)
    $(document).on('change', '.mobile_code', function(){
       mobile =  $(this).val();
       newVal = code+mobile;
       $('.number_new').val(newVal)
    });
     
});

</script>
@stop


