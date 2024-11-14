@extends('layouts.app')
<style>
    .headingbox h1 {
    font-size: 34px;
    margin-bottom: 40px;
    font-weight: 700;
    color: #033355;
}
.headingbox h1 strong, .signupsection h4 span, .thankarea h4 span, .webtext h2 strong {
    color: #ffc145;
    font-weight: 700;
}
.businesssection .headingbox h1::before, .headingbox h1:before {
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
.businesssection .headingbox h1::after, .headingbox h1:after {
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
.h1_new{
    font-size:70px;
    font-weight:700;
}
.placement{
    width: 80%;
    top: 45%;
    -webkit-transform: translate(0, -50%);
    left: 10%;
    transform: translate(0, -50%);
}
.p_mo{
    padding-top:0px !important;
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
}
</style>
@section('content')

@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp
    @switch($val->type)
        @case(1)
            @php
            $image = $val->image;
            $first_body = $val->body;
            $first_title = $val->title;
            @endphp
            @break
        @case(2)
            @php
            $second_image = $val->image;
            $second_title = $val->title;
            @endphp
            @break
        @case(4)
            @php
            $four_title = $val->title;
            @endphp
            @break
        @case(6)
            @php
            $six_title = $val->title;
            @endphp
            @break
        @case(8)
            @php
            $eight_title = $val->title;
            @endphp
            @break
        @case(11)
            @php
            $eleven_title = $val->title;
            @endphp
            @break
    @endswitch
@endforeach
@php
 $phoneNumber = config('site.whatsapp'); 

$newPhoneNumber = str_replace(['+', '-'], '', $phoneNumber);

$encodedPhoneNumber = urlencode($newPhoneNumber);
@endphp
<div class="innerbanner-area">
      @if (!empty($image))
        <img src="{{ asset('uploads/'.$image) }}" alt="{{ getImageNameAlt($image) }}"  style="" class="banner_image_new"> 
        <div class="about-area-two-contain position-absolute heading_new placement">
            <h1 class="text-white h1_new ">{{$page->page_name}}</h1> 
        </div>
      @else
        <img src="{{ asset('frontend/images/be-bran-innerbanner3.webp') }}" alt="be-bran-innerbanner3">
        <div class="about-area-two-contain position-absolute heading_new placement">
            <h1 class="h1_new">{{$page->page_name}}</h1> 
        </div>
      @endif
  <nav class="breadcrumb mt-3 d-none">
    <div class="container">
      <a class="breadcrumb-item" href="{{url('/')}}">home</a>
      <span class="breadcrumb-item active">Blog List</span>
    </div>
  </nav>
</div>
    <div class="testimonial-area p_mo">
        <div class="innerbanner-area">
            <nav class="breadcrumb">
                <div class="container">
                <a class="breadcrumb-item" href="{{url('/')}}">home</a>
                <span class="breadcrumb-item active">{{ $page->page_name}}</span>
                </div>
            </nav>
        </div>
        <!-- testimonial about area start -->
        <div class="testimonial-about-area">
            <div class="container">
                <div class="headingbox text-center">
                    <h3>@if(!empty($second_title)) {!! $second_title !!}@endif</h3>
                </div>
                <div class="testimonial-about-main-body">
                    <div class="testimonial-about-bg d-flex"><img src="{{ asset('uploads/'.$second_image) }}" alt="{{ getImageNameAlt($second_image) }}"></div>
                    <div class="testimonial-about-body">                
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-3 row-cols-xxl-3 testimonial-about-box-list">
                            @php $count = 0 @endphp
                          @foreach ($extra_data as $key=>$val)
                            @if ($val->type == 3 && $count < 2)
                                <div class="col">
                                    <div class="card testimonial-about-card">
                                        <div class="card-img d-flex">
                                            @if (file_exists(public_img_path($val->video_img)))
                                            <img src="{{ asset('uploads/' . $val->video_img) }}" alt="{{ getImageNameAlt($val->video_img) }}">
                                            @else
                                                Image not found
                                            @endif
                                            <div class="card-img-popup d-flex align-items-center justify-content-center">
                                                <div class="video-main">
                                                    <div class="promo-video">
                                                        <div class="waves-block">
                                                            <div class="waves wave-1"></div>
                                                            <div class="waves wave-2"></div>
                                                            <div class="waves wave-3"></div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ $val->video_url }}" class="video video-popup" data-fancybox><i class="fa-brands fa-youtube"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="video-main">
                                                <div class="promo-video">
                                                    <div class="waves-block">
                                                        <div class="waves wave-1"></div>
                                                        <div class="waves wave-2"></div>
                                                        <div class="waves wave-3"></div>
                                                    </div>
                                                </div>
                                                <div class="video video-popup">
                                                    @if (file_exists(public_img_path($val->image)))
                                                    <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                                                    @else
                                                        Image not found
                                                    @endif
                                                </div>
                                            </div>
                                            <h3>{{ $val->title }}</h3>
                                            <h4>{{ $val->sub_title }}</h4>
                                            {!! $val->body !!}
                                        </div>
                                    </div>
                                </div>
                                @php $count++ @endphp
                            @endif
                          @endforeach
                            
                        </div>
                        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-3 row-cols-xxl-3 testimonial-about-box-list">
                            @php $counterNum = 0 @endphp
                            @foreach ($extra_data as $key=>$val)
                                 @if ($val->type == 3)
                                    @if ($counterNum >= 2)
                                    <div class="col">
                                        <div class="card testimonial-about-card">
                                            <div class="card-img d-flex">
                                                @if (file_exists(public_img_path($val->video_img)))
                                                <img src="{{ asset('uploads/' . $val->video_img) }}" alt="{{ getImageNameAlt($val->video_img) }}">
                                                @else
                                                    Image not found
                                                @endif
                                                <div class="card-img-popup d-flex align-items-center justify-content-center">
                                                    <div class="video-main">
                                                        <div class="promo-video">
                                                            <div class="waves-block">
                                                                <div class="waves wave-1"></div>
                                                                <div class="waves wave-2"></div>
                                                                <div class="waves wave-3"></div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ $val->video_url }}" class="video video-popup" data-fancybox><i class="fa-brands fa-youtube"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="video-main">
                                                    <div class="promo-video">
                                                        <div class="waves-block">
                                                            <div class="waves wave-1"></div>
                                                            <div class="waves wave-2"></div>
                                                            <div class="waves wave-3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="video video-popup">
                                                        @if (file_exists(public_img_path($val->image)))
                                                        <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                                                        @else
                                                            Image not found
                                                        @endif
                                                    </div>
                                                </div>
                                                <h3>{{ $val->title }}</h3>
                                                <h4>{{ $val->sub_title }}</h4>
                                                {!! $val->body !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @php $counterNum ++ @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <!-- testimonial about area stop -->
        <!-- testimonial review area start -->
        <div class="testimonial-review-area">
            <div class="container">
                <div class="headingbox text-center">
                    <h3>@if(!empty($four_title)) {!! $four_title !!}@endif</h3>
                </div>
                <div class="owl-carousel owl-theme testimonial-review-carousel" id="testimonial-review-slider">
                    @foreach ($extra_data as $val)
                    @if($val->type == 5 )
                    <div class="card testimonial-review-card">
                        <div class="card-img d-flex">
                            @if(!empty($val->image))
                                @if (file_exists(public_img_path($val->image)))
                                <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                                @else Image not found @endif
                            @endif
                        </div>
                        <div class="card-body">
                            <h3>{{ $val->title }}</h3>
                            <div class="star">
                            @for ($i= 0; $i < $val->sub_title ; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            </div>
                            {!! $val->body !!}                 
                        </div>
                        <div class="card-review-icon d-flex">
                            @if(!empty($val->image2))
                            @if (file_exists(public_img_path($val->image2)))
                            <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                            @else Image not found @endif
                        @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- testimonial review area stop -->
        <!-- testimonial feedback area start -->
        <div class="testimonial-feedback-area">
            <div class="container">
                <div class="headingbox">
                    <h3>@if(!empty($six_title)) {!! $six_title !!}@endif</h3>
                </div>
                <div class="owl-carousel owl-theme testimonial-feedback-carousel" id="testimonial-feedback-slider">
                    @foreach ($extra_data as $key=>$val)
                    @if($val->type == 7 )
                    <div class="card testimonial-feedback-card">
                        <div class="d-flex align-items-center testimonial-feedback-media">
                            <div class="flex-shrink-0 d-inline-flex media-img">
                                <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                            </div>
                            <div class="flex-grow-1 media-body">
                                <h4>@if(!empty($val->title)) {!! $val->title !!}@endif</h4>
                                <h5>@if(!empty($val->sub_title)) {!! $val->sub_title !!}@endif</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!empty($val->body)) {!! $val->body !!}@endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- testimonial feedback area stop -->
    </div>
    <section class="faqbg" style="background:url({{ asset('frontend/images/faqbg.webp') }}) center no-repeat fixed;">
        <div class="container">
          <div class="headingbox text-center ">
            <h3>{!! $eight_title !!}</h3>
          </div>
        </div>
      </section>
      <section class="faqarea">
        <div class="container">
           <div class="row">
              <div class="col-lg-6">
                 <div class="accordion" id="accordionExample">
                    @foreach ($extra_data as $key=>$faq)
                      @if($faq->type == 9 )
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingOne{{$key}}">
                              <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne{{ $key }}">{{ $faq->title }}</button>
                          </h2>
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
                        @if($faq->type == 10 )
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
          <h3>@if(!empty($eleven_title)) {!! $eleven_title !!}@endif</h3>
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
      @if (session('success'))
          $('html, body').animate({
              scrollTop: $('#homeForm').offset().top
          }, 1000);
      @endif
  });
</script>
@stop


