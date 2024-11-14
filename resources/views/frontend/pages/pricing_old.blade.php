@extends('layouts.app')
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
            <div class="bannerForm">
               <form method="post" action="{{ url('service-form') }}" autocomplete="off">
                  @csrf
                  @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                  @endif
                  <div class="form">
                  <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
                  <h4>{!! $second_title !!} </h4>
                  <div class="form-group">
                     <div class="icon"><i class="fa-solid fa-user"></i></div>
                     <input type="text" class="form-control" name="name" placeholder="Full name *" >
                     @if ($errors->has('name'))
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                  </div>
                  
                  <div class="form-group">
                     <div class="icon"><i class="fa-solid fa-phone"></i></div>
                     <input type="number" class="form-control" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" >
                     @if ($errors->has('phone'))
                     <span class="text-danger">{{ $errors->first('phone') }}</span>
                     @endif
                  </div>
                  
                  <div class="form-group FormSelect">
                     <div class="icon"><i class="fa-solid fa-gear"></i></div>
                     <select class="form-control" name="serviceName">
                        <option>Select Service</option>
                        @foreach ($allServiceData as $key=>$value)
                        <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                     <div class="icon"><i class="fa-solid fa-tag"></i></div>
                     <input type="number" class="form-control" name="budget" placeholder="Budget *" >
                     @if ($errors->has('budget'))
                     <span class="text-danger">{{ $errors->first('budget') }}</span>
                     @endif
                  </div>
                  <div class="form-group">
                     <div class="icon"><i class="fa-solid fa-link"></i></div>
                     <input type="text" class="form-control" name="website_url" placeholder="Website url" >
                     @if ($errors->has('website_url'))
                     <span class="text-danger">{{ $errors->first('website_url') }}</span>
                     @endif
                  </div>
                  <div class="captcha_box mb-2">
                     <!-- <img src="{{ asset('frontend/images/be-bran-captchanew.webp ')}}" alt="be-bran-captchanew"> -->
                  <div id="html_element"></div>
                              @if ($errors->has('g-recaptcha-response'))
                              <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>

                              @elseif ($errors->has('recaptcha_validate'))
                              <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                              @endif
                  </div>
                  <button type="submit" class="btn-primary w-100">{{ $second_btn_text }}</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="packages-area seosection">
      <div class="innerbanner-area">
         <nav class="breadcrumb">
         <div class="container">
            <a class="breadcrumb-item" href="{{url('/')}}">home</a>
            <span class="breadcrumb-item active">{{ $page->page_name}}</span>
         </div>
         </nav>
      </div>
      <div class="container">
         <div class="headingbox text-center">
            <h3>@if(!empty($third_title)){!! $third_title !!}@endif</h3>
         </div>
         <div class="helpyou-body">
            <nav class="nav nav-tabs justify-content-center" id="nav-tab1" role="tablist">
               @php $incrimentId = 1; @endphp
               @foreach($packag_category as $categories)
                  <a class="nav-link @if($incrimentId == 1){{ 'active' }}@endif" data-bs-toggle="tab" href="#@if(!empty($categories->slug)){{ $categories->slug }}@endif" role="tab">
                     <h2>@if(!empty($categories->title)){{ $categories->title }}@endif<span>@if(!empty($categories->sub_title)){{ $categories->sub_title }}@endif</span></h2>
                  </a>
               @php $incrimentId++; @endphp
               @endforeach
            </nav>
            <div class="tab-content mt-5" id="nav-tabContent1">
               @php $incrimentId = 1; @endphp
               @foreach($packag_category as $categories)
                  <div class="tab-pane fade @if($incrimentId == 1){{ 'show active' }}@endif" id="@if(!empty($categories->slug)){{ $categories->slug }}@endif" role="tabpanel">
                     <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 row-cols-lg-4 row-cols-xxl-4 g-0">
                        @foreach($packag_plan as $plans)
                           @if($plans->category->slug == $categories->slug)
                              <div class="col">
                                 <div class="packages-box @if(!empty($plans->sub_title)){{ 'package-active' }}@endif">
                                    @if(!empty($plans->sub_title))
                                       <div class="popular-package">{{ $plans->sub_title }}</div>
                                    @endif
                                    <div class="tag">@if(!empty($plans->title)){{ $plans->title }}@endif</div>
                                    <div class="dropdown packages">
                                       <div class="btn"> 
                                          <h5>
                                             <span class="d-flex align-items-center mb-1">
                                                <del>{{ Currency() }}@if(!empty($plans->discount_price)){{ $plans->discount_price }}@endif</del><span>{{ Currency() }}@if(!empty($plans->price)){{ $plans->price }}@endif</span><sub>/mo</sub></span>
                                             <span class="d-flex  align-items-center"><span class="term-length">@if(!empty($plans->discount_percentage)){!! $plans->discount_percentage !!}@endif</span>
                                          </h5>
                                       </div>
                                    </div>
                                    <div class="text">
                                       <p>@if(!empty($plans->content_title)){!! $plans->content_title !!}@endif</p>
                                    </div>
                                    @if(!empty($plans->content)){!! $plans->content !!}@endif
                                    <div class="btn-box">
                                       <a href="#{{ $categories->slug .'_'. $incrimentId }}" onclick="active_plans('{{ $categories->slug .'_'. $incrimentId }}')" class="btn-primary">
                                          @if(!empty($plans->button_text)){{ $plans->button_text }}@endif
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           @endif
                        @endforeach
                     </div>
                  </div>
               @php $incrimentId++; @endphp
               @endforeach
            </div>
         </div>
         <div class="btn-brouse-box text-center">
            <a href="#browse-features" class="btn-primary">@if(!empty($fourth_btn_text)){!! $fourth_btn_text !!}@endif</a>
         </div>
      </div>
   </div>
   <div class="whyus toolareasection">
      <div class="container">
         <div class="toolssection">
            <div class="headingbox text-center">
               <h3>@if(!empty($fifth_title)){!! $fifth_title !!}@endif</h3>
               @if(!empty($fifth_body)){!! $fifth_body !!}@endif
            </div>
            <!-- tools slider start -->
            <div class="owl-carousel owl-theme tools-carousel" id="tools-slider">
              @foreach ($extra_data as $key=>$val)
              @if($val->type == 6 )
               <div class="item">
                  <figure class="tools-imgBox d-flex align-items-center justify-content-center">
                      @if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif
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
   <div class="Increment-area talknumber talksection" style="background: url(images/detilsbg.webp);">
      <div class="container">
         <div class="headingbox text-center">
            <h3>@if(!empty($seventh_title)){!! $seventh_title !!}@endif</h3>
         </div>
         <div class="incrarea">
          @foreach ($extra_data as $key=>$val)
          @if($val->type == 8 )
            <div class="incrementbox">
               <div class="incrementicon">@if(!empty($val->image) && file_exists(public_img_path($val->image))) <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> @else Image not found @endif</div>
               <h4>@if(!empty($val->title)){!! $val->title !!}@endif</h4>
               <h3>@if(!empty($val->sub_title)){!! $val->sub_title !!}@endif</h3>
            </div>
          @endif
          @endforeach
         </div>
      </div>
   </div>
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
                           <button class="btn-read" onclick="window.location.href = '{{ url($val->redirect_to) }}'" type="button">Read More</button>
                     @else
                           <button class="btn-read" onclick="window.location.href = '{{ url('seo-result/'.$val->slug) }}'" type="button">Read More</button>
                     @endif
                  </div>
               </div>
            @endforeach
         </div>
         <div class="text-center">
            <a href="@if(!empty($nine_btn_url)){!! $nine_btn_url !!}@endif" class="btn-primary">@if(!empty($nine_btn_text)){!! $nine_btn_text !!}@endif</a>
         </div>
      </div>
   </div>
   <div class="featuresection">
      <div class="container">
         <div class="headingbox text-center">
            <h3>@if(!empty($tenth_title)){!! $tenth_title !!}@endif</h3>
         </div>
         <div class="main-comparisontable comparebox">
            <div class="seosection p-0">
               <div class="helpyou-body" id="browse-features">
                  <nav class="nav nav-tabs justify-content-center mb-2" id="nav-tab2" role="tablist">
                     @php $incrimentId = 1; @endphp
                     @foreach($packag_category as $categories)
                        <a class="nav-link nav-link-keep-active @if($incrimentId == 1){{ 'active' }}@endif" data-bs-toggle="tab" href="#@if(!empty($categories->slug)){{ $categories->slug.'_'.$incrimentId }}@endif" onclick="active_deactive_plans('{{ $categories->slug .'_'. $incrimentId }}'); deactive_plans('{{ $categories->slug .'_'. $incrimentId }}')" role="tab">
                           <h2>@if(!empty($categories->title)){{ $categories->title }}@endif<span>@if(!empty($categories->sub_title)){{ $categories->sub_title }}@endif</span></h2>
                        </a>
                     @php $incrimentId++; @endphp
                     @endforeach
                  </nav>
                  <div class="tab-content" id="nav-tabContent2">
                     @php $incrimentId = 1; @endphp
                     @foreach($packag_category as $categories)
                        <div class="tab-pane deactive-nav-link fade @if($incrimentId == 1){{ 'active show' }}@endif"  href="#@if(!empty($categories->slug)){{ $categories->slug.'_'.$incrimentId }}@endif" id="@if(!empty($categories->slug)){{ $categories->slug.'_'.$incrimentId }}@endif">
                           <table class="price-table">
                              <tbody>
                                 <tr class="sticky-header">
                                    <td></td>
                                    @foreach($packag_type as $types)
                                    @if($types->category->slug == $categories->slug)
                                       <td>
                                          <div class="litebox">
                                             <h3>@if(!empty($types->title)){{ $types->title }}@endif</h3>
                                             <div class="d-flex align-items-center justify-content-center">
                                                <h5>{{ Currency() }}@if(!empty($types->discount_title)){{ $types->discount_title }}@endif</h5>
                                                <h4>@if(!empty($types->discount_sub_title)){{ $types->discount_sub_title }}@endif</h4>
                                             </div>
                                             <h2>{{ Currency() }}@if(!empty($types->price)){{ $types->price }}@endif</h2>
                                             <a href="@if(!empty($types->button_url)){{ $types->button_url }}@else{{ '#' }}@endif" class="btn-primary subnow">@if(!empty($types->button_txt)){{ $types->button_txt }}@endif</a>
                                          </div>
                                       </td>
                                    @endif 
                                    @endforeach
                                 </tr>
                                 @if(!empty($packag_title_subtitle))
                                    @php $check = ''; @endphp
                                    @foreach($packag_title_subtitle as $titleSubtitle)
                                    @if($titleSubtitle->category->slug == $categories->slug)
                                       @php $column= 1; $title_id = $titleSubtitle->title_id; @endphp
                                       @foreach($packag_type as $types)
                                       @if($types->category->slug == $categories->slug)
                                       @php $column++; @endphp
                                       @endif
                                       @endforeach
                                       @if($check != $title_id)
                                       @php $check = $title_id @endphp
                                          <tr>
                                             <td colspan="{{$column}}">
                                                <h4 class="text-start">{{ $titleSubtitle->title->title }}</h4>
                                             </td>
                                          </tr>
                                       @endif
                                          
                                       <tr>
                                          <td>{{ $titleSubtitle->sub_title }}</td>
                                          @foreach($packag_type as $types)
                                          @if($types->category->slug == $categories->slug)

                                             @php 
                                                $typess = explode(',',$titleSubtitle->types);
                                                $switch = explode(',',$titleSubtitle->switch);
                                             @endphp
                                             @foreach ($typess as $key => $oneType)
                                                @if($oneType == $types->id)   
                                                   @if($switch[$key] == '1')
                                                      <td class="check"><i class="fa-solid fa-circle-check"></i></td>
                                                   @else
                                                      <td class="check"><i class="fa-solid fa-close"></i></td>
                                                   @endif
                                                @endif 
                                             @endforeach
                                             
                                          @endif
                                          @endforeach
                                       </tr>
                                    @endif
                                    @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     @php $incrimentId++; @endphp
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="seopackagesection">
      <div class="container">
         <div class="headingbox text-center">
            <h3>@if(!empty($eleveth_title)){!! $eleveth_title !!}@endif</h3>
         </div>
         @if(!empty($eleveth_body)){!! strip_tags($eleveth_body, '<p><ul><li></li></ul>') !!}@endif
         <div class="planarea cityhelpbody">
            <div class="planarea-body">
               <div class="row align-items-center">
                  <div class="col-lg-4">
                     <nav class="nav nav-tabs justify-content-center" id="nav-tab3" role="tablist">
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
                     <div class="tab-content" id="nav-tabContent3">
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
                              @if(!empty($val->body)){!! strip_tags($val->body) !!}@endif
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

   <!-- seoclientsay area start -->
   <div class="seoclientsay-area ourclient">
      <div class="container">
         <div class="headingbox">
            <h3>@if(!empty($thirteen_title)){!! $thirteen_title !!}@endif</h3>
         </div>
         <div class="seoclientsay-sliderArea">
            <div class="owl-carousel owl-theme seoclientsay-carousel" id="seoclientsay-slider">
              @php $increment = 1 ;@endphp
              @foreach ($extra_data as $key=>$val)
              @if($val->type == 14 ) 
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
                     <p>@if($limitedContent){!! $limitedContent.'...' !!}@else {!! $limitedContent !!} @endif</p>
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


