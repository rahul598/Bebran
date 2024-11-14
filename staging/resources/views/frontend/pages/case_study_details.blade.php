@extends('layouts.app')

@section('content')
@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp
    @switch($val->type)
        @case(1)
            @php
            $first_image = $val->image;
            $first_title = $val->title;
            @endphp
            @break
        @case(2)
            @php
                $second_title = $val->title;
                $second_body = $val->body;
                $second_sub_title = $val->sub_title;
            @endphp
            @break
        @case(3)
            @php $third_title = $val->title; @endphp
            @break
        @case(6)
            @php $sixth_title = $val->title; @endphp
            @break

        @case(8)
            @php
                $eight_title = $val->title;
            @endphp
            @break
        @case(10)
            @php
                $tenth_title = $val->title;
            @endphp
            @break
        @case(13)
            @php
                $thirteen_title = $val->title;
            @endphp
            @break
    @endswitch
@endforeach
<div class="service-inner-banner digital-marketing city-banner" style="background: url({{ (!empty($first_image) && file_exists(public_img_path($first_image))) ? asset('uploads/' . $first_image) : 'Image not found' }});">
    <div class="container">
       <div class="service-inner-body d-md-flex justify-content-between align-items-center">
          <div class="digitaltext">
             <h1>@if(!empty($first_title)) {!! $first_title !!}@endif</h1>
          </div>
       </div>
    </div>
 </div>
 
    <div class="innercasestudyarea mt-5">
    <div class="innerbanner-area">
      <nav class="breadcrumb">
        <div class="container">
          <a class="breadcrumb-item" href="{{url('/')}}">home</a>
          <a class="breadcrumb-item" href="{{url('case-studies')}}">Case Study</a>
          <span class="breadcrumb-item active">{{ $page->page_name}}</span>
        </div>
      </nav>
    </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <div class="card innercasestudycard sticky-top">
          <div class="card-header">
            <h3>@if(!empty($second_title)) {!! $second_title !!}@endif</h3>
          </div>
          <div class="card-body">
            <h4>@if(!empty($second_sub_title)) {!! $second_sub_title !!}@endif</h4>
            
                @if(!empty($second_body)) {!! $second_body !!}@endif
            
            <h4>@if(!empty($third_title)) {!! $third_title !!}@endif</h4>
            
            @foreach ($extra_data as $val)
                @if($val->type == 4 )
                <div class="d-flex align-items-stretch innercasestudy-media">
                  <div class="flex-shrink-0 d-inline-flex align-items-center justify-content-center media-icon">
                    <figure><img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}"></figure>
                  </div>
                  <div class="flex-grow-1 media-body">
                    <h4>@if(!empty($val->title)) {!! $val->title !!}@endif</h4>
                    <small>@if(!empty($val->sub_title)) {!! $val->sub_title !!}@endif</small>
                  </div>
                </div>
               @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8">
        <div class="innercasestudy-contain-area">
            @foreach ($extra_data as $val)
                @if($val->type == 5 )
                  <div class="case-study-heading">
                    <h1>@if(!empty($val->title)) {!! $val->title !!}@endif</h1>
                        @if(!empty($val->body)) {!! $val->body !!}@endif
                  </div>
                  <div class="innercasestudy-contain-img">
                    <figure><img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}"></figure>
                  </div>
                @endif
            @endforeach
        </div>        
      </div>
    </div>
  </div>
</div>
    <div class="seoclientsay-area ourclient d-none">
      <div class="container">
         <div class="headingbox">
            <h3>@if(!empty($sixth_title)){!! $sixth_title !!}@endif</h3>
         </div>
         <div class="seoclientsay-sliderArea">
            <div class="owl-carousel owl-theme seoclientsay-carousel" >
              @php $increment = 1 ;@endphp
              @foreach ($extra_data as $key=>$val)
              @if($val->type == 7 ) 
               <div class="seoclientsay-sliderBox shadow">
                  <div class="seoclientsay-img d-flex"> 
                  @if(!empty($val->video_img) && file_exists(public_img_path($val->video_img))) 
                    <img src="{{ asset('uploads/' . $val->video_img) }}" alt="{{ getImageNameAlt($val->video_img) }}"> 
                  @else 
                    Image not found 
                  @endif
                   <a href="@if(!empty($val->video_url)){!! $val->video_url !!}@endif" data-fancybox="gallery"
                        data-caption="Caption #{{$increment}}" class="videoView d-flex align-items-center justify-content-center"><i
                           class="fa-brands fa-youtube"></i></a> </div>
                  <div class="seovideotext">
                     <div class="d-flex justify-content-between align-items-center">
                        <h4>@if(!empty($val->title)){{ $val->title }}@endif</h4>
                        <div class="seomapicon">
                          @if(!empty($val->image) && file_exists(public_img_path($val->image))) 
                            <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> 
                          @else 
                            Image not found 
                          @endif
                        </div>
                     </div>
                     <h5>@if(!empty($val->sub_title)){{ $val->sub_title }}@endif</h5>
                     <p>@if(!empty($val->body)){!! strip_tags($val->body) !!}@endif</p>
                  </div>
               </div>
              @php $increment++ ;@endphp
              @endif
              @endforeach
            </div>
         </div>
      </div>
   </div>
    <!--------------ourclient video ------------------>
    @include('frontend.fix-widgets.video_client')
    <!--------------ourclient video ------------------>  
    
   <div class="review">
      <div class="container">
         <div class="headingbox text-center ">
            <h3>@if(!empty($eight_title)){!! $eight_title !!}@endif</h3>
         </div>
         <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>
            @php $increment = 1; @endphp
            @foreach ($extra_data as $key=>$val)
            @if($val->type == 9 )   
              <div class="col-lg-3 col-md-6 col-sm-6 cordbox">
                <div class="review-box card">
                    <div class="card-img">
                      @if(!empty($val->image) && file_exists(public_img_path($val->image))) 
                        <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> 
                      @else 
                        Image not found 
                      @endif
                    </div>
                    <div class="card-body">
                      <div class="card-icon">
                        @if(!empty($val->image) && file_exists(public_img_path($val->image))) 
                          <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> 
                        @else 
                          Image not found 
                        @endif
                      </div>
                      <h4>@if(!empty($val->title)){{ $val->title }}@endif</h4>
                      <ul>
                          @if(!empty($val->sub_title) && $val->sub_title <= 5)
                            @for($i = 1; $i <= $val->sub_title; $i++)
                              <li><i class="fa-solid fa-star"></i></li>
                            @endfor
                          @else
                            @for($i = 1; $i <= 5; $i++)
                              <li><i class="fa-solid fa-star"></i></li>
                            @endfor
                          @endif
                      </ul>
                      <p>@if(!empty($val->body)){!! strip_tags($val->body) !!}@endif</p>
                      <div class="rfacebook text-center">
                        @if(!empty($val->image2) && file_exists(public_img_path($val->image2))) 
                          <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"> 
                        @else 
                          Image not found 
                        @endif
                      </div>
                    </div>
                </div>
              </div>
            @php $increment++;@endphp
            @endif
            @endforeach
         </div>
      </div>
   </div>
   <section class="faqbg" style="background:url({{asset('frontend/images/faqbg.webp')}}) center no-repeat fixed;">
      <div class="container">
         <div class="headingbox text-center ">
            <h3>@if(!empty($tenth_title)){!! $tenth_title !!}@endif</h3>
         </div>
      </div>
   </section>
   <section class="faqarea">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="accordion" id="accordionExample">
                @php $increment = 1; $collapsed = 'collapsed'; @endphp
                    @foreach ($extra_data as $key=>$val)
                        @if($val->type == 11 )
                          <div class="accordion-item">
                             <h2 class="accordion-header" id="headingOne{{$increment}}">
                                <button class="accordion-button @if($increment != '1'){{ $collapsed }}@endif" type="button" data-bs-toggle="collapse"
                                   data-bs-target="#collapseOne{{$increment}}" aria-expanded="true" aria-controls="collapseOne{{$increment}}">@if(!empty($val->title)){{ $val->title }}@endif</button>
                             </h2>
                             <div id="collapseOne{{$increment}}" class="accordion-collapse collapse @if($increment == '1'){{ 'show' }}@endif" aria-labelledby="headingOne{{$increment}}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                   <p>@if(!empty($val->body)){!! strip_tags($val->body) !!}@endif</p>
                                </div>
                             </div>
                          </div>
                        @php $increment++;@endphp
                    @endif
                @endforeach  
               </div>
            </div>
            <div class="col-lg-6">
               <div class="accordion" id="accordionExample1">
                @php $increment = 1; @endphp
                @foreach ($extra_data as $key=>$val)
                    @if($val->type == 12 )
                      <div class="accordion-item">
                         <h2 class="accordion-header" id="headingOne111{{$increment}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                               data-bs-target="#collapseOne111{{$increment}}" aria-expanded="@if($increment == '1'){{ 'true' }}@else{{ 'false' }}@endif" aria-controls="collapseOne111{{$increment}}">@if(!empty($val->title)){{ $val->title }}@endif</button>
                         </h2>
                         <div id="collapseOne111{{$increment}}" class="accordion-collapse collapse " aria-labelledby="headingOne111{{$increment}}"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>@if(!empty($val->body)){!! strip_tags($val->body) !!}@endif</p>
                            </div>
                         </div>
                      </div>
                    @php $increment++;@endphp
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
            <h3>@if(!empty($thirteen_title)){!! $thirteen_title !!}@endif</h3>
         </div>
         <div class="row">
            @foreach ($blogData as $key=>$val)
            <div class="col-lg-4 col-md-6">
               <div class="bolgbox">
                  <div class="bolimg">
                     @if(!empty($val->image2) && file_exists(public_img_path($val->image2))) 
                        <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"> 
                      @else 
                        Image not found 
                      @endif
                     <div class="btxt">
                        <div class="bicon">
                        @if(!empty($val->author_image) && file_exists(public_img_path($val->author_image))) 
                           <img src="{{ asset('uploads/' . $val->author_image) }}" alt="{{ getImageNameAlt($val->author_image) }}"> 
                        @else 
                           Image not found 
                        @endif
                        </div>
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
                     $text = !empty($val->body) ? $val->body : '';
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