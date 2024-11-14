@extends('layouts.app')
@section('more-css')
<style>
.digitaltext p{
    font-size: 24px  !important;
    line-height: 28px  !important;
}
@media(max-width:767px){
    .citytextarea .citytext{
        top: 30px;
    }
    .citytextarea .citytext .city-area{
         margin-bottom: 88px;
    }
       
}
@media (max-width: 479.98px) {
    .ourservice .headingbox {
        margin-bottom: 90px;
    }
    .seoclientsay-area .headingbox {
        margin-bottom: 160px;
    }
    .seoclientsay-area .seoclientsay-sliderArea{
        top: -75px !important;
    }
}
.faqbg .headingbox h2, .seoclientsay-area .headingbox h2 {
    color: #ffffff !important;
}
.faqbg .headingbox h2:before, .faqbg .headingbox h2:after,  .seoclientsay-area .headingbox h2:before, .seoclientsay-area .headingbox h2:after {
    background-color: #ffffff;
    color: #fff !important;
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
    /*color: #fff;*/
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
/*.digitaltext p{*/
/*    font-size: 24px  !important;*/
/*    line-height: 28px  !important;*/
/*}*/
@media (max-width: 410px){ 
 
    .digitaltext h1 {
        font-size: 26px !important;
    }
    .digitaltext p {
        font-size: 16px !important;
        color: #00003a;
    }
    .digitaltext{
        margin-top: 10% !important; 
    }
    .digitaltext{
        margin-top: 10% !important; 
    }
    .service-inner-body .bannerForm {
        margin-top: 15% !important;
    } 
    .service-inner-banner{
        background-attachment: fixed !important;
    }
    
}

/* Ensure the table has full width and border-collapse for better alignment */
.feature_heading_table td:not(:first-child), .feature_heading_table th:not(:first-child) {
    border-top: 1px solid #ddd !important;
    border-right: 1px solid #ddd !important;
    border-bottom: 1px solid #ddd !important;
    border-left: 1px solid #ddd !important;
}
.feature_heading_table td:first-child, .feature_heading_table th:first-child {
    border-top: 1px solid #ddd !important;
    border-right: 1px solid #ddd !important;
    border-bottom: 1px solid #ddd !important;
    border-left: none !important;
}
/* Style the check mark container */
/*.check img {*/
/*    display: inline-block;*/
/*    vertical-align: middle;*/
/*}*/

/* Ensure the feature heading has proper margin and font size */
/*.feature_heading {*/
/*    margin-bottom: 15px;*/
/*    font-size: 18px;*/
/*    font-weight: bold;*/
/*}*/

/* Ensure the feature table has proper margin */
.features_table {
    margin-top: 30px;
}
.sticky{
    top:-41px !important;
}
.diff_color{
    background: #edeffe;
} 
.border-new {
    border: 1px solid lightgrey !important;
    padding: 5px !important;
    border-radius: 10px !important;
}
.duration {
    text-align: center !important;
    padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x) !important;
    line-height: 15px !important;
}
.duration:hover{
    /*background-color: var(--color-ghostwhite);*/
    background-color: #facc15;
    border-radius: var(--br-8xs); 
    padding: var(--padding-5xs) var(--padding-base);
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
    /*color: #000 !important;*/
    /*background-color: #eef0fd !important;*/
        color: #fff !important;
    background-color: #192052 !important;
}
.sub_title{
    font-size: var(--font-size-3xs-1);
    
}
</style>
@endsection
@section('content')
@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp

    @switch($val->type)
        @case(1)
            @php 
            $first_title = $val->title;
            $first_image = $val->image;
            $first_sub_title = $val->sub_title;
            @endphp

            @break
        @case(2)
            @php
                $second_title = $val->title;
                $second_btn_text = $val->btn_text;
            @endphp
            @break
        @case(3)
            @php
                $third_title = $val->title;
                $third_body = $val->body;
                $third_image = $val->image;
            @endphp
            @break
        @case(5)
            @php
                $fifth_title = $val->title;
                $fifth_sub_title = $val->sub_title;
            @endphp
            @break
        @case(7)
            @php
                $seventh_title = $val->title;
                $seventh_sub_title = $val->sub_title;
            @endphp
            @break
        @case(9)
            @php
                $ninth_title = $val->title;
                $ninth_body = $val->body;
            @endphp
            @break
        @case(11)
            @php
                $eleven_title = $val->title;
            @endphp
            @break
        @case(13)
            @php
                $thirteen_title = $val->title;
                $thirteen_body = $val->body;
            @endphp
            @break
        @case(15)
            @php $fifteen_title = $val->title; @endphp
            @break
        @case(17)
            @php $seventeen_title = $val->title; @endphp
            @break
        @case(19)
            @php $nineteen_title = $val->title; @endphp
            @php $nineteen_btn_text = $val->btn_text; @endphp
            @php $nineteen_btn_url = $val->btn_url; @endphp
            @break
        @case(20)
            @php $twenty_title = $val->title; @endphp
            @php $twenty_btn_text = $val->btn_text; @endphp
            @php $twenty_btn_url = $val->btn_url; @endphp
            @break
        @case(21)
            @php $twenty_one_title = $val->title; @endphp
            @break
        @case(23)
            @php $twenty_three_title = $val->title; @endphp
            @break
        @case(25)
            @php $twenty_five_title = $val->title; @endphp
            @break
        @case(28)
            @php $twenty_eight_title = $val->title; @endphp
            @break
        @case(29)
            @php $twenty_nine_title = $val->title; @endphp
            @php $twenty_nine_sub_title = $val->sub_title; @endphp
            @php $twenty_nine_btn_text = $val->btn_text; @endphp
            @php $twenty_nine_btn_url = $val->btn_url; @endphp
            @php $twenty_nine_body = $val->body; @endphp
            @break
        @case(31)
            @php $thirty_one_title = $val->title; @endphp
            @php $thirty_one_sub_title = $val->sub_title; @endphp
            @php $thirty_one_btn_text = $val->btn_text; @endphp
            @php $thirty_one_btn_url = $val->btn_url; @endphp
            @php $thirty_one_body = $val->body; @endphp
            @break
        @case(33)
            @php $thirty_three_title = $val->title; @endphp
            @php $thirty_three_sub_title = $val->sub_title; @endphp
            @php $thirty_three_btn_text = $val->btn_text; @endphp
            @php $thirty_three_btn_url = $val->btn_url; @endphp
            @php $thirty_three_body = $val->body; @endphp
            @break
        @case(35)
            @php $thirty_five_title = $val->title; @endphp
            @php $thirty_five_sub_title = $val->sub_title; @endphp
            @php $thirty_five_btn_text = $val->btn_text; @endphp
            @php $thirty_five_btn_url = $val->btn_url; @endphp
            @php $thirty_five_body = $val->body; @endphp
            @break
        @case(37)
            @php $thirty_seven_btn_text = $val->btn_text; @endphp
            @php $thirty_seven_btn_url = $val->btn_url; @endphp
            @break
    @endswitch
@endforeach
    <div class="service-inner-banner digital-marketing" style="background: url({{ (!empty($first_image) && file_exists(public_img_path($first_image))) ? asset('uploads/' . $first_image) : 'Image not found' }});">
        
         <div class="container">
            <div class="service-inner-body d-md-flex justify-content-between align-items-center">
               <div class="digitaltext">
                  <h1>@if(!empty($first_title)) {!! $first_title !!}@endif</h1>
                  <p>@if(!empty($first_sub_title)) {!! $first_sub_title !!}@endif</p>
               </div>
               @include('frontend.form.other_pages_slider_form')
            </div>
         </div>
      </div>
      <section class="about-area-two digitalabout">
        <div class="innerbanner-area">
            <nav class="breadcrumb">
              <div class="container">
                <a class="breadcrumb-item" href="{{url('/')}}">home</a>
                <span class="breadcrumb-item">{{ $cities_name }}</span>
                <a class="breadcrumb-item" href="{{ url('/'.$slug) }}">{{ $page->page_name}}</a>
                <span class="breadcrumb-item active">{{ $business_name }}</span>
              </div>
            </nav>
          </div>
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <figure class="about-area-two-img">
                      @if(!empty($third_image))
                        @if (file_exists(public_img_path($third_image)))
                            <img src="{{ asset('uploads/' . $third_image) }}" alt="{{ getImageNameAlt($third_image) }}">
                            @else
                                Image not found
                            @endif
                      @endif
                  </figure>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="about-area-two-contain citytextarea">
                     <h2>@if(!empty($third_title)) {!! $third_title !!}@endif</h2>
                     @if(!empty($third_body)) {!! $third_body !!}@endif
                     <div class="citytext">
                      @foreach ($extra_data as $key=>$val)
                        @if($val->type == 4 )
                            <div class="city-area d-flex align-items-center">
                            <div class="cityicon">
                                <img src="{{asset('frontend/images/beicon.png')}}" alt="#" >
                            </div>
                            <div class="citybody">
                                <h6>@if(!empty($val->title)) {!! $val->title !!}@endif
                                </h6>
                            </div>
                            </div>
                            @endif
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="ourservice">
         <div class="container">
            <div class="headingbox text-center">
                 <h2 class="first_color bottom_line">@if(!empty($fifth_title)) {!! $fifth_title !!}@endif</h2>
                <h2>@if(!empty($fifth_sub_title)) {!! $fifth_sub_title !!}@endif</h2>
            </div>
            <div class="row">
            @foreach ($extra_data as $key=>$val)
                @if($val->type == 6 )
                    <div class="col-lg-4 col-md-6 col-sm-6 seoarea d-flex align-items-stretch">
                        <div class="seobox cityseoboxin">
                            <div class="cityseoiconarea">
                                <div class="seoicon">
                                    @if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif
                                </div>
                                <div class="iconbody">
                                    <h4>{{ $val->title }}</h4>
                                </div>
                            </div>
                              {!! $val->body !!}
                            <div class="d-flex align-items-center justify-content-center seoboxfooter">
                                <a href="{{ $val->btn_url }}" class="btn-info">{{ $val->btn_text }}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
         </div>
      </div>
      <div class="professional businesssection innerbusiness">
         <div class="container">
            <div class="headingbox text-center">
               <h2>@if(!empty($seventh_title)) {!! $seventh_title !!}@endif <br>
                    @if(!empty($seventh_sub_title)) {!! $seventh_sub_title !!}@endif
                </h2>
            </div>
             <div class="inner-missionvision-area">
            <div class="inner-missionvision-main-tabarea d-flex align-items-start justify-content-between">
               <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                 @php $countNum = 0; @endphp
                    @foreach ($extra_data as $key=>$val)
                    @if($val->type == 8 )
                        @php $countNum++; @endphp
                        <button class="nav-link {{ $countNum ==1 ? 'active' : '' }}" data-bs-toggle="pill" data-bs-target="#tab{{ $key }}">
                            <span class="iconbox">
                               @if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif
                            </span>
                            <h4>{!! $val->title !!}</h4>
                            <span class="tabbox_contant fade show">
                                {!! $val->body !!} 
                            </span>
                        </button>
                        @endif
                    @endforeach
               
               </div>
               <div class="tab-content" id="v-pills-tabContent">
                    @php $count = 0; @endphp
                    @foreach ($extra_data as $key=>$val)
                      @if($val->type == 8 )
                        @php $count++; @endphp
                            <div class="tab-pane fade {{ $count == 1 ? 'show active' : '' }}" id="tab{{ $key }}">
                                <div class="thumblebox_area" style="background: url({{ (!empty($val->image2) && file_exists(public_img_path($val->image2))) ? asset('uploads/' . $val->image2) : 'Image not found' }});">
                                </div>
                            </div>
                        @endif
                    @endforeach
               </div>
             </div>
            </div>

         </div>
      </div>
      <div class="helpyou approacharea">
         <div class="container">
            <div class="headingbox text-center">
                <h2>@if(!empty($ninth_title)) {!! $ninth_title !!}@endif</h2>
                <p>@if(!empty($ninth_body)) {!! $ninth_body !!}@endif</p>
            </div>
            <!-- helpyou body start -->
            <div class="helpyou-body">
               <nav class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                    @php $counter = 0; @endphp
                    @foreach ($extra_data as $key=>$val)
                        @if($val->type == 10 )
                        @php $counter++; @endphp
                        <a class="nav-link {{ $counter == 1 ? 'active' : '' }}"  data-bs-toggle="tab" href="#SERVICES{{ $key }}" role="tab">
                            <div class="helpimg">
                                @if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif
                            </div>
                        </a>
                       @endif
                    @endforeach
               </nav>
               <div class="tab-content" id="nav-tabContent">
                    @php $counteIncrease = 0; @endphp
                     @foreach ($extra_data as $key=>$val)
                        @if($val->type == 10 )
                        @php $counteIncrease ++; @endphp
                        <div class="tab-pane fade {{ $counteIncrease == 1 ? 'show active' : '' }}" id="SERVICES{{ $key }}" role="tabpanel">
                            <div class="citytab">
                                <div class="row">
                                <div class="col-lg-7">
                                    <h3>{!! $val->title !!}</h3>
                                        {!! $val->body !!}
                                    <a href="{{ $val->btn_url }}" class="btn-primary mt-4">{{ $val->btn_text }}</a>
                                </div>
                                <div class="col-lg-5">
                                    <div class="busineimg">
                                        @if(!empty($val->image2) && file_exists(public_img_path($val->image2))) <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"> @else Image not found @endif
                                     </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
               </div>
            </div>
            <!-- helpyou body stop -->
         </div>
      </div>
      <div class="tooluse aboutdigital aboutcity cityaboutarea">
         <div class="container">
            <div class="headingbox text-center">
                <h2>@if(!empty($eleven_title)) {!! $eleven_title !!}@endif</h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xxl-3 g-5">
                @foreach ($extra_data as $key=>$val)
                    @if($val->type == 12 )
                    <div class="col d-flex align-items-stretch">
                        <div class="card about-service-box">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <div class="w-100 text-center">
                                <div class="seoiconarea">
                                    <figure class="icon">
                                       @if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif
                                    </figure>
                                    <div class="digitalbody">
                                        <h4>{{ $val->title }}</h4>
                                    </div>
                                </div>
                                {!! $val->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
         </div>
      </div>
      <div class="whyus tools-area">
         <div class="container">
            <div class="toolssection">
               <div class="headingbox text-center">
                 <h2>{!! $tools_we_use[0]->title !!}</h2>
                 <div>{!! $tools_we_use[0]->body !!}</div>
              </div>
              <!-- tools slider start -->
              <div class="owl-carousel owl-theme tool-carousel" id="tools-slider">
                @foreach ($tools_we_use as $key=>$val)
                    @if($val->type == 12 )
                        <div class="item">
                            <figure class="tools-imgBox d-flex align-items-center justify-content-center">
                                @if(!empty($val->image) && file_exists(public_img_path($val->image))) 
                                <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}" height="49" width="181"> 
                                @else 
                                Image not found 
                                @endif
                            </figure>
                        </div>
                    @endif
                @endforeach
              </div>
               <!-- tools slider stop -->
            </div>
         </div>
      </div>
      <!-- inner seolanding area start -->
       <div class="Increment-area talknumber d-none" style="background: url({{ asset('frontend/images/detilsbg.webp') }});">

            <div class="container">
            <div class="headingbox text-center">
                <h3>@if(!empty($fifteen_title)) {!! $fifteen_title !!}@endif</h3>
            </div>
            <div class="incrarea">
                @foreach ($extra_data as $key=>$val)
                    @if($val->type == 16 )
                        <div class="incrementbox">
                            <div class="incrementicon">
                                @if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif
                            </div>
                            <h4>{!! $val->title !!}</h4>
                            <h3>{!! $val->sub_title !!}</h3>
                        </div>
                    @endif
                @endforeach
            </div>
            </div>
        </div>
      <!-- inner seolanding area stop --> 
      <!-------------- Our Strength-------------->
    @include('frontend.fix-widgets.our_strength')
    <!-------------- Our Strength-------------->
<!------------our partners------------>
@include('frontend.fix-widgets.our_partners_other_page')
<!------------our partners------------>

        <div class="portfoliosection">
            <div class="container">
            <div class="headingbox text-center">
                <h2>@if(!empty($nineteen_title)) {!! $nineteen_title !!}@endif</h2>
            </div>
            <div id="toolcarousel" class="owl-carousel portfolio-carousel">
                @foreach ($seo_results as $key=>$val)
                      <div class="card seoLandingBox">
                         <div class="card-img d-flex"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"></div>
                         <div class="card-body">
                            <h4>{{ $val->page_title }}</h4>
                            <p>{!! $val->body !!}</p>
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
                            <a href="{{ url('seo-result/'.$val->slug) }}" class="btn-read text-center">Read More</a>
                         </div>
                      </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="@if(!empty($nineteen_btn_url)) {!! $nineteen_btn_url !!}@endif" class="btn-primary">@if(!empty($nineteen_btn_text)) {!! $nineteen_btn_text !!}@endif</a>
            </div>
            </div>
        </div>
    @if(!empty($data_new) && !empty($data1) && !empty($data2) && !empty($data3))
      <div class="packages-area">
         <div class="container d-none">
            <div class="headingbox text-center">
                <h2>@if(!empty($twenty_title)) {!! $twenty_title !!}@endif</h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 row-cols-lg-4 row-cols-xxl-4 g-0">
               <div class="col">
                  <div class="packages-box">
                     <div class="tag">@if(!empty($twenty_nine_title)){{$twenty_nine_title}}@endif</div>
                     <!-- <h3><i class="fa-solid fa-dollar-sign"></i>25.00</h3> -->
                     <div class="dropdown packages">
                            @php
                            $hasDisplayed = false; // Initialize a variable to track if content has been displayed
                            @endphp

                            @foreach ($extra_data as $key => $val)
                                @if ($val->type == 30 && !$hasDisplayed)
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <h5>
                                            <div class="d-flex align-items-center mb-1">{!! $val->title !!}</div>
                                            <div class="d-flex align-items-center">{!! $val->sub_title !!}</div>
                                        </h5>
                                    </button>
                                    @php
                                    $hasDisplayed = true; // Set the flag to indicate content has been displayed
                                    @endphp
                                @endif
                            @endforeach

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($extra_data as $key=>$val)
                                @if($val->type == 30 )
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <h5>
                                        <div class="d-flex align-items-center">{!!$val->title!!}</div>
                                        <div class="d-flex  align-items-center">{!!$val->sub_title!!}
                                        </div>
                                    </h5>
                                </a>
                                    @endif
                            @endforeach
                        </ul>
                     </div>
                     <div class="text">
                        <p>@if(!empty($twenty_nine_sub_title)){!!$twenty_nine_sub_title!!}@endif</p>
                     </div>
                     <ul>
                        @if(!empty($twenty_nine_body)){!!$twenty_nine_body!!}@endif
                     </ul>
                     <div class="btn-box">
                        <a href="@if(!empty($twenty_nine_btn_url)){{$twenty_nine_btn_url}}@endif" class="btn-primary">@if(!empty($twenty_nine_btn_text)){{$twenty_nine_btn_text}}@endif</a>
                     </div>
                  </div>
               </div>
               <div class="col">
                  <div class="packages-box package-active ">
                     <div class="popular-package">popular</div>
                     <div class="tag"> @if(!empty($thirty_one_title)){{$thirty_one_title}}@endif</div>
                     <!-- <h3><i class="fa-solid fa-dollar-sign"></i>50.00</h3> -->
                     <div class="dropdown packages">

                            @php
                            $hasDisplayed = false; // Initialize a variable to track if content has been displayed
                            @endphp

                            @foreach ($extra_data as $key => $val)
                                @if ($val->type == 32 && !$hasDisplayed)
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <h5>
                                            <div class="d-flex align-items-center mb-1">{!! $val->title !!}</div>
                                            <div class="d-flex align-items-center">{!! $val->sub_title !!}</div>
                                        </h5>
                                    </button>
                                    @php
                                    $hasDisplayed = true; // Set the flag to indicate content has been displayed
                                    @endphp
                                @endif
                            @endforeach


                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($extra_data as $key=>$val)
                                @if($val->type == 32 )
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <h5>
                                        <div class="d-flex align-items-center">{!!$val->title!!}</div>
                                        <div class="d-flex  align-items-center">{!!$val->sub_title!!}
                                        </div>
                                    </h5>
                                </a>
                                    @endif
                            @endforeach
                        </ul>
                     </div>
                     <div class="text">
                        <p>@if(!empty($thirty_one_sub_title)){!!$thirty_one_sub_title!!}@endif</p>
                     </div>
                      <ul>
                        @if(!empty($thirty_one_body)){!!$thirty_one_body!!}@endif
                     </ul>
                      <div class="btn-box">
                        <a href="@if(!empty($thirty_one_btn_url)){{$thirty_one_btn_url}}@endif" class="btn-primary">@if(!empty($thirty_one_btn_text)){{$thirty_one_btn_text}}@endif</a>
                     </div>
                  </div>
               </div>
               <div class="col">
                  <div class="packages-box">
                     <div class="tag">@if(!empty($thirty_three_title)){!!$thirty_three_title!!}@endif</div>
                     <!-- <h3><i class="fa-solid fa-dollar-sign"></i>65.00</h3> -->
                     <div class="dropdown packages">
                        @php
                            $hasDisplayed = false; // Initialize a variable to track if content has been displayed
                            @endphp

                            @foreach ($extra_data as $key => $val)
                                @if ($val->type == 34 && !$hasDisplayed)
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <h5>
                                            <div class="d-flex align-items-center mb-1">{!! $val->title !!}</div>
                                            <div class="d-flex align-items-center">{!! $val->sub_title !!}</div>
                                        </h5>
                                    </button>
                                    @php
                                    $hasDisplayed = true; // Set the flag to indicate content has been displayed
                                    @endphp
                                @endif
                            @endforeach
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($extra_data as $key=>$val)
                                @if($val->type == 34 )
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <h5>
                                        <div class="d-flex align-items-center">{!!$val->title!!}</div>
                                        <div class="d-flex  align-items-center">{!!$val->sub_title!!}
                                        </div>
                                    </h5>
                                </a>
                                    @endif
                            @endforeach
                        </ul>
                     </div>
                     <div class="text">
                        <p>@if(!empty($thirty_three_sub_title)){!!$thirty_three_sub_title!!}@endif</p>
                     </div>
                     <ul>
                        @if(!empty($thirty_three_body)){!!$thirty_three_body!!}@endif
                     </ul>
                     <div class="btn-box">
                        <a href="@if(!empty($thirty_three_btn_url)){{$thirty_three_btn_url}}@endif" class="btn-primary">@if(!empty($thirty_three_btn_text)){{$thirty_three_btn_text}}@endif</a>
                     </div>
                  </div>
               </div>
               <div class="col">
                  <div class="packages-box">
                     <div class="tag">@if(!empty($thirty_five_title)){{$thirty_five_title}}@endif</div>
                     <!-- <h3><i class="fa-solid fa-dollar-sign"></i>100.00</h3> -->
                    <div class="dropdown packages">
                        @php
                            $hasDisplayed = false; // Initialize a variable to track if content has been displayed
                            @endphp

                            @foreach ($extra_data as $key => $val)
                                @if ($val->type == 36 && !$hasDisplayed)
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <h5>
                                            <div class="d-flex align-items-center mb-1">{!! $val->title !!}</div>
                                            <div class="d-flex align-items-center">{!! $val->sub_title !!}</div>
                                        </h5>
                                    </button>
                                    @php
                                    $hasDisplayed = true; // Set the flag to indicate content has been displayed
                                    @endphp
                                @endif
                            @endforeach
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($extra_data as $key=>$val)
                                @if($val->type == 36 )
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <h5>
                                        <div class="d-flex align-items-center">{!!$val->title!!}</div>
                                        <div class="d-flex  align-items-center">{!!$val->sub_title!!}
                                        </div>
                                    </h5>
                                </a>
                                    @endif
                            @endforeach
                        </ul>
                     </div>
                     <div class="text">
                        <p>@if(!empty($thirty_five_sub_title)){!!$thirty_five_sub_title!!}@endif</p>
                     </div>
                     <ul>
                        @if(!empty($thirty_five_body)){!! $thirty_five_body!!}@endif
                     </ul>
                     <div class="btn-box">
                        <a href="@if(!empty($thirty_five_btn_url)){{$thirty_five_btn_url}}@endif" class="btn-primary">@if(!empty($thirty_five_btn_text)){{$thirty_five_btn_text}}@endif</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="btn-brouse-box text-center">
               <a href="@if(!empty($thirty_seven_btn_url)){!!$thirty_seven_btn_url!!}@endif" class="btn-primary">@if(!empty($thirty_seven_btn_text)){!!$thirty_seven_btn_text!!}@endif</a>
            </div>
         </div>
          @include('frontend.inc.price_card')
            
      </div>
    @endif
      
      <!-------------------------feature section-------------------------->
      {{-- @include('frontend.inc.features_price_compare') --}}
      <!-------------------------feature section-------------------------->
    <!--------------ourclient video ------------------>
        @include('frontend.fix-widgets.video_client')
    <!--------------ourclient video ------------------> 
        
       <div class="review">
            <div class="container">
            <div class="headingbox text-center ">
                <h2>@if(!empty($twenty_three_title)) {!! $twenty_three_title !!}@endif</h2>
            </div>
            <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>
                @foreach ($extra_data as $val)
                    @if($val->type == 24 )
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
                            <h4>{{ $val->title }}</h4>
                            <ul>
                            @for ($i= 0; $i < $val->sub_title ; $i++)
                            <li><i class="fa-solid fa-star"></i></li>
                            @endfor
                            </ul>
                            <div>{!! $val->body !!}</div>
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
                <h2>@if(!empty($twenty_five_title)) {!! $twenty_five_title !!}@endif</h2>
            </div>
            </div>
        </section>
       <section class="faqarea">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="accordion" id="accordionExample">
                    @foreach ($extra_data as $key => $faq)
                        @if ($faq->type == 26)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne{{ $key }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne{{ $key }}">{{ $faq->title }}</button>
                                </h2>
                                <div id="collapseOne{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne{{ $key }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div>{!! $faq->body !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordion" id="accordionExample1">
                    @foreach ($extra_data as $key => $faq)
                        @if ($faq->type == 27)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $key }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">{{ $faq->title }}</button>
                                </h2>
                                <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample1">
                                    <div class="accordion-body">
                                        <div>{!! $faq->body !!}</div>
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
                    <h3>@if(!empty($twenty_five_title)){!! $twenty_eight_title !!}@endif</h3>
                </div>
                <div class="row">
                    @foreach ($blogData as $key=>$val)
                    <div class="col-lg-4 col-md-6">
                    <div class="bolgbox">
                        <div class="bolimg"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                        <div class="btxt">
                            <div class="bicon"><img src="{{ asset('uploads/'.$val->author_image) }}" alt="{{ getImageNameAlt($val->author_image) }}"></div>
                            <div class="stxt">
                            <h5>@if(!empty($val->page_title)){{ $val->page_title }}@endif</h5>
                            <h6>@if(!empty($val->bannertext)){{ $val->bannertext }}@endif</h6>
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
                            <div>@if($limitedContent){!! $limitedContent.'...' !!}@else {!! $limitedContent !!} @endif</div>
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
    $('.duration').on('click', function() {  
        // Get the ID of the clicked tab
        var tabId = $(this).attr('href'); 
        // Hide all tab panes except the one clicked
        $('.price_card_figma .tab-pane').not(tabId).removeClass('show active').addClass('hide display_none');
        
        // Show the clicked tab pane
        $(tabId).addClass('show active').removeClass('hide display_none');
    });
        
        //  sticky header
        
         $(window).scroll(function(){
            var scrollPos = $(window).scrollTop();
            var featuresTableTop = $('.features_table').offset().top; 
            var featuresTableHeight = $('.features_table').innerHeight();
            console.log(featuresTableHeight)
            if (scrollPos > featuresTableTop) {
                $('#browse-features').addClass('sticky');
                if (scrollPos < featuresTableTop + featuresTableHeight) {
                    $('#browse-features').removeClass('sticky');
                }
            } else {
                $('#browse-features').removeClass('sticky');
            }
        });
});
</script>

@stop
