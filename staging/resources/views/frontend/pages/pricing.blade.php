@extends('layouts.app') 
@section('more-css')
<style>
/* Ensure the table has full width and border-collapse for better alignment */
/*.feature_heading_table {*/
/*    width: 100%;*/
/*    border-collapse: collapse;*/
/*}*/

/* Add padding and text alignment for table cells */
/*.feature_heading_table td {*/
/*    padding: 10px;*/
/*    text-align: center;*/
/*    vertical-align: middle;*/
/*}*/

/* Additional styling for subheading cells */
/*.content_feature {*/
/*    text-align: left;*/
/*}*/

/* Optional: Add borders for better visual separation */
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
          $first_image = $val->image;
          $first_title = $val->title;
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
          @endphp
        @break
        @case(4)
          @php
              $fourth_btn_text = $val->btn_text;
              $fourth_btn_url = $val->btn_url;
          @endphp
        @break
        @case(5)
          @php
              $fifth_title = $val->title;
              $fifth_body = $val->body;
          @endphp
        @break 
        @case(7)
          @php
              $seventh_title = $val->title;
          @endphp
        @break
        @case(9)
          @php
              $nine_title = $val->title;
              $nine_btn_text = $val->btn_text;
              $nine_btn_url = $val->btn_url;
          @endphp 
        @break
        @case(10)
          @php
              $tenth_title = $val->title;
          @endphp
        @break
        @case(11)
          @php
              $eleveth_title = $val->title;
              $eleveth_body = $val->body;
          @endphp
        @break
        @case(13)
          @php
              $thirteen_title = $val->title;
          @endphp 
        @break
        @case(15)
          @php
              $fifteen_title = $val->title;
          @endphp
        @break
        @case(17)
          @php
              $seventeen_title = $val->title;
          @endphp
        @break
        @case(20)
          @php
              $twenty_title = $val->title;
          @endphp
        @break
    @endswitch
@endforeach
<div class="service-inner-banner digital-marketing" style="background: url({{ (!empty($first_image) && file_exists(public_img_path($first_image))) ? asset('uploads/' . $first_image) : 'Image not found' }});">
      <div class="container">
         <div class="service-inner-body d-md-flex justify-content-between align-items-center">
            <div class="seotext">
               <h1>@if(!empty($first_title)) {!! $first_title !!}@endif</h1>
               <h3>@if(!empty($first_sub_title)) {!! $first_sub_title !!}@endif</h3>
            </div>
            @include('frontend.form.other_pages_slider_form')
         </div>
      </div>
   </div>
   @if(!empty($data_new) && !empty($data1) && !empty($data2) && !empty($data3))
    <div class="packages-area seosection ">
        <div class="innerbanner-area d-none">
            <nav class="breadcrumb">
                <div class="container">
                    <a class="breadcrumb-item" href="{{url('/')}}">home</a>
                    <span class="breadcrumb-item active">{{ $page->page_name}}</span>
                </div>
            </nav>
        </div> 
          @include('frontend.inc.price_card') 
    </div>
    @endif
   <div class="whyus toolareasection">
      <div class="container">
         <div class="toolssection">
            <div class="headingbox text-center">
                 <h3>{!! $tools_we_use[0]->title !!}</h3>
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
   <!-------------- Our Strength-------------->
    @include('frontend.fix-widgets.our_strength')
    <!-------------- Our Strength-------------->
   <!-- inner seolanding area stop -->
   
   <div class="portfoliosection">
      <div class="container">
         <div class="headingbox text-center">
            <h3>@if(!empty($nine_title)){!! $nine_title !!}@endif</h3>
         </div>
         <div id="toolcarousel" class="owl-carousel portfolio-carousel">
            @foreach ($seo_results as $key=>$val)
               <div class="card seoLandingBox">
                  <div class="card-img d-flex"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"></div>
                  <div class="card-body">
                     <h4>@if(!empty($val->page_title)){{ $val->page_title }}@endif</h4>
                     <p>@if(!empty($val->body)){!! strip_tags($val->body) !!}@endif</p>
                     <div class="d-flex align-items-center seoLandingBoxCountry">
                        <div class="flex-shrink-0  media-img">
                           <img src="{{ asset('uploads/'.$val->bannerimage) }}" alt="{{ getImageNameAlt($val->bannerimage) }}">
                        </div>
                        <div class="flex-grow-1 media-body">
                           <h5>@if(!empty($val->bannertext)){{ $val->bannertext }}@endif</h5>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="searchPercent d-flex align-items-center justify-content-center">
                        <h5>@if(!empty($val->author_url)){!! $val->author_url !!}@endif</h5>
                     </div>
                     @if(!empty($val->redirect_to))
                           <a href="{{ url($val->redirect_to) }}" class="btn-read text-center">{{ $val->page_name }}
                     @else
                           <a href="{{ url('seo-result/'.$val->slug) }}" class="btn-read text-center">
                     @endif 
                     Read More </a>
                  </div>
               </div>
            @endforeach
         </div>
         <div class="text-center">
            <a href="@if(!empty($nine_btn_url)){!! $nine_btn_url !!}@endif" class="btn-primary">@if(!empty($nine_btn_text)){!! $nine_btn_text !!}@endif</a>
         </div>
      </div>
   </div>
   <!----------------feature compare ------------>
    @include('frontend.inc.features_price_compare')
    <!----------------feature compare ------------>
    
   <div class="seopackagesection">
      <div class="container">
         <div class="headingbox text-center">
            <h3>@if(!empty($eleveth_title)){!! $eleveth_title !!}@endif</h3>
         </div>
         <div>@if(!empty($eleveth_body)){!! strip_tags($eleveth_body, '<p></p><ul><li></li></ul>') !!}@endif</div>
         <div class="planarea cityhelpbody">
            <div class="planarea-body">
               <div class="row align-items-center">
                  <div class="col-lg-4">
                     <nav class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                    @php $increment = 1 ;@endphp
                    @foreach ($extra_data as $key=>$val)
                    @if($val->type == 12 )
                        <a class="nav-link @if($increment == '1'){{ 'active' }}@endif" data-bs-toggle="tab" href="#contrary{{ $increment }}" role="tab"
                           aria-selected="@if($increment == '1'){{ 'true' }}@else{{ 'false' }}@endif">
                           <div class="helpimg">
                            @if(!empty($val->image) && file_exists(public_img_path($val->image))) 
                              <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> 
                            @else 
                              Image not found 
                            @endif
                           </div>
                           <span>@if(!empty($val->title)){!! $val->title !!}@endif</span>
                        </a>
                    @php $increment++ ;@endphp
                    @endif
                    @endforeach
                     </nav>
                  </div>
                  <div class="col-lg-8">
                     <div class="tab-content nav-tabContent">
                      @php $increment = 1 ;@endphp
                      @foreach ($extra_data as $key=>$val)
                      @if($val->type == 12 )
                        <div class="tab-pane fade @if($increment == '1'){{ 'active show' }}@endif" id="contrary{{ $increment }}" role="tabpanel">
                           <figure class="busineimg">
                              @if(!empty($val->image2) && file_exists(public_img_path($val->image2))) 
                              <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}"> 
                            @else 
                              Image not found 
                            @endif
                           </figure>
                           <div class="marketing-contain">
                              <h3>@if(!empty($val->title)){{ $val->title }}@endif</h3>
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
         </div>
      </div>
   </div>

    <!--------------ourclient video ------------------>
        @include('frontend.fix-widgets.video_client')
    <!--------------ourclient video ------------------> 
   
   <div class="review">
      <div class="container">
         <div class="headingbox text-center ">
            <h3>@if(!empty($fifteen_title)){!! $fifteen_title !!}@endif</h3>
         </div>
         <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>
            @php $increment = 1; @endphp
            @foreach ($extra_data as $key=>$val)
            @if($val->type == 16 )   
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
            <h3>@if(!empty($seventeen_title)){!! $seventeen_title !!}@endif</h3>
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
                @if($val->type == 18 )
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
                @if($val->type == 19 )
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
            <h3>@if(!empty($twenty_title)){!! $twenty_title !!}@endif</h3>
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
    $('.new_click_new').on('click', function() {  
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
            var featuresTableTop = $('.featuresection').offset().top; 
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

mobileOnlySlider(".mySlider", false, false, 768);

        function mobileOnlySlider($slidername, $dots, $arrows, $breakpoint) { 
        	var slider = $($slidername);
        	var settings = {
        		mobileFirst: true,
        		dots: $dots,
        		arrows: $arrows,
        		responsive: [
        			{
        				breakpoint: $breakpoint,
        				settings: "unslick"
        			}
        		]
        	};
        
        	slider.slick(settings);
        
        	$(window).on("resize", function () {
        		if ($(window).width() > $breakpoint) {
        			return;
        		}
        		if (!slider.hasClass("slick-initialized")) {
        			return slider.slick(settings);
        		}
        	});
        } // Mobile Only Slider
</script>
@stop


