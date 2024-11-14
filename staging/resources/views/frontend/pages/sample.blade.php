@extends('layouts.app')

@section('content')
@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp

    @switch($val->type)
        @case(1)
            @php 
            $first_title = $val->title;
            $first_image = $val->image;
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
            @endphp
            @break
        @case(4)
            @php
                $fourth_title = $val->title;
            @endphp
            @break
        @case(6)
            @php
                $sixth_title = $val->title;
                $sixth_btn_text = $val->btn_text;
                $sixth_btn_url = $val->btn_url;
            @endphp
            @break
        @case(7)
            @php
                $seventh_title = $val->title;
            @endphp
            @break
        @case(9)
            @php
                $ninth_title = $val->title;
            @endphp
            @break
        @case(11)
            @php
                $eleven_title = $val->title;
            @endphp
            @break
        @case(14)
            @php
                $fourteen_title = $val->title;
            @endphp
            @break
    @endswitch
@endforeach

<div class="service-inner-banner digital-marketing case-study-banner" style="background: url({{ (!empty($first_image) && file_exists(public_img_path($first_image))) ? asset('uploads/' . $first_image) : 'Image not found' }});">

    <div class="container">
      <div class="service-inner-body d-md-flex justify-content-between align-items-center">
        <div class="seotext">
            <h1 class="h1_new">@if(!empty($first_title)) {!! $first_title !!}@endif</h1>
        </div>
       @include('frontend.form.other_pages_slider_form')
      </div>
    </div>
  </div>
  <div class="packages-area seosection casestudysection">
    <div class="innerbanner-area">
        <nav class="breadcrumb">
            <div class="container">
            <a class="breadcrumb-item" href="{{url('/')}}">home</a>
            <span class="breadcrumb-item active">{{ $page->page_name}}</span>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="casestudytab">
            <nav class="nav nav-tabs justify-content-center" id="nav-tab1" role="tablist">
                <a class="nav-link active" data-bs-toggle="tab" href="#allcasestudies" role="tab" aria-selected="true">All Sample</a>
        
                @foreach($sampleCategoryData as $key => $category)
                    <a class="nav-link" data-bs-toggle="tab" href="#{{ $category[0]->slug }}" role="tab" aria-selected="false" tabindex="-1">{{ $category[0]->name }}</a>
                @endforeach
        
            </nav>
        
            <div class="tab-content" id="nav-tabContent1">
                <div class="tab-pane fade active show" id="allcasestudies" role="tabpanel">
                    <div class="headingbox text-center">
                        <h3>All <strong>@if(!empty($third_title)) {!! $third_title !!}@endif</strong></h3>
                    </div>
                    <div class="row">
                        @foreach($sampleCategoryData as $key => $category)
                            @foreach($category as $study)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="portfoliosection portfoliobox">
                                            <div class="card seoLandingBox">
                                                <div class="card-img d-flex">
                    @if(!empty($study->image) && file_exists(public_img_path($study->image))) <img src="{{ asset('uploads/' . $study->image) }}" alt="{{ getImageNameAlt($study->image) }}"> @else Image not found @endif

                                                </div>
                                                <div class="card-body">
                                                    <div class="portfolioicon">
                                                        @if(!empty($study->image2) && file_exists(public_img_path($study->image2))) <img src="{{ asset('uploads/' . $study->image2) }}" alt="{{ getImageNameAlt($study->image2) }}"> @else Image not found @endif
                                                    </div>
                                                    <h6>{{ $study->title }}</h6>
                                                    {!! $study->body !!}
                                                    <a href="{{ $study->btn_url }}" class="read">{{ $study->btn_text }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
        
                @foreach($sampleCategoryData as $key => $category)
                    <div class="tab-pane fade" id="{{ $category[0]->slug }}" role="tabpanel">
                        <div class="headingbox text-center">
                            <h3>{{ $category[0]->name }} <strong>@if(!empty($third_title)) {!! $third_title !!}@endif</strong></h3>
                        </div>
                        <div class="row">
                            @foreach($category as $study)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="portfoliosection portfoliobox">
                                            <div class="card seoLandingBox">
                                                <div class="card-img d-flex">
                                                    @if(!empty($study->image) && file_exists(public_img_path($study->image))) <img src="{{ asset('uploads/' . $study->image) }}" alt="{{ getImageNameAlt($study->image) }}"> @else Image not found @endif
                                                </div>
                                                <div class="card-body">
                                                    <div class="portfolioicon">
                                                        @if(!empty($study->image2) && file_exists(public_img_path($study->image2))) <img src="{{ asset('uploads/' . $study->image2) }}" alt="{{ getImageNameAlt($study->image2) }}"> @else Image not found @endif
                                                    </div>
                                                    <h6>{{ $study->title }}</h6>
                                                    {!! $study->body !!}
                                                    <a href="{{ $study->btn_url }}" class="read">{{ $study->btn_text }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
  </div>
  
  <!-- inner seolanding area start --> 
  <!-------------- Our Strength-------------->
    @include('frontend.fix-widgets.our_strength')
    <!-------------- Our Strength-------------->
  <!-- inner seolanding area stop -->
  
  <div class="portfoliosection">
    <div class="container">
       <div class="headingbox text-center">
          <h3>@if(!empty($sixth_title)) {!! $sixth_title !!}@endif</h3>
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
                <button class="btn-info" onclick="window.location.href = '{{ url('seo-result/'.$val->slug) }}'" type="button">Read More</button>
             </div>
          </div>
          @endforeach
       </div>
       <div class="text-center">
          <a href="@if(!empty($sixth_btn_url)) {!! $sixth_btn_url !!}@endif" class="btn-primary">@if(!empty($sixth_btn_text)) {!! $sixth_btn_text !!}@endif</a>
       </div>
    </div>
 </div>

    <!-- seoclientsay area start --> 
    <!--------------ourclient video ------------------>
        @include('frontend.fix-widgets.video_client')
    <!--------------ourclient video ------------------> 
    <!-- seoclientsay area stop -->
 <div class="review">
  <div class="container">
     <div class="headingbox text-center ">
        <h3>@if(!empty($ninth_title)) {!! $ninth_title !!}@endif</h3>
     </div>
     <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>
      @foreach ($extra_data as $val)
          @if($val->type == 10 )
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
        <h3>@if(!empty($eleven_title)) {!! $eleven_title !!}@endif</h3>
     </div>
  </div>
</section>
<section class="faqarea">
  <div class="container">
     <div class="row">
        <div class="col-lg-6">
           <div class="accordion" id="accordionExample">
              @foreach ($extra_data as $key=>$faq)
                @if($faq->type == 12 )
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
                  @if($faq->type == 13 )
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
      <h3>@if(!empty($fourteen_title)) {!! $fourteen_title !!}@endif</h3>
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
});
</script>
@stop
