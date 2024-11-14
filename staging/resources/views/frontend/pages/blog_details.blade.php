@extends('layouts.app') 
@section('content')
@foreach ($blog_details as $val)
    @php $page_id = $val->id; @endphp
    @if ($val->type == 1)
      @php $image = $val->image2; @endphp
    @endif
@endforeach
@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp

    @switch($val->type)
        @case(2)
            @php 
            $second_title = $val->title;
            @endphp
            @break
    @endswitch
@endforeach
<style>
    .faqbg{
            height: 590px;
    }
    .heading_new{
        top: 45%; 
        left: 39%; 
        transform: translate(-50%, -50%);
    }
    .h1_new{
        font-size: 45px;
        color: #fff;
    }
    @media(max-width:767px){
    .heading_new{
        top: 32%;
        left: 50%;
    }
    .h1_new{
            font-size: 40px;
            display:none;
    }
    .blog-details-social2{
        padding-top:45px;
    }
    .post_title{
        font-size: 26px;
    }
}
.countries-we-serve-area{
    padding-top:10% !important;
}
#toc {
    margin-bottom: 20px;
}

#toc ul {
    list-style: none;
    padding: 0;
}

#toc li {
    margin: 5px 0;
}

#toc a {
    text-decoration: none;
    color: #007bff;
}

#toc a:hover {
    text-decoration: underline;
}
@media(max-width:767px){
    .banner_image_new{
        
    }
}
</style>
  <!--<title>{{ $blog_details[0]->page_name }}</title>-->
<div class="innerbanner-area">
      @if (!empty($image))
          <img src="{{ asset('uploads/'.$image) }}" alt="{{ getImageNameAlt($image) }}" class="banner_image_new" width="1519" height="380"> 
        @else
          <img src="{{ asset('frontend/images/be-bran-innerbanner4.webp')}}" alt="be-bran-innerbanner4"> 
      @endif
    <nav class="breadcrumb">
      <div class="container">
        <a class="breadcrumb-item" href="{{url('/')}}">home</a>
        <a class="breadcrumb-item" href="{{url('/blog')}}">blog</a>
        <span class="breadcrumb-item active">{{ $blog_details[0]->page_name }}</span>
      </div>
    </nav>
  </div>
  <section class="inner-blog-list-area">
    <div class="container">
      <div class="row">
        <div class="col-xxl-8 col-xxl-8 col-lg-8 col-md-8">
          <div class="blog-details-box-area">
            <div class="blog-details-box1 card">
                <figure class="card-img d-flex">
                    <img src="{{ asset('uploads/'.$blog_details[0]->image2) }}" alt="{{ getImageNameAlt($blog_details[0]->image2) }}" width="854" height="449">
                </figure>
                <div class="card-body blog_bot">
                  <h1 class="post_title pb-3">{{ $blog_details[0]->page_name }}</h1>
                  
                  <ul class="details-blog-slocial-list pb-3">
                    @php
                        $dateString = $blog_details[0]->created_at;
                        $formattedDate = date_convert($dateString,8)
                    @endphp
                    <li><i class="fa-regular fa-clock"></i><span class="date">{{ $formattedDate }}</span></li>
                    <li>
                      Share :
                      <a href="{{ $followLinks[0]->value }}" target="_blank" class="social-details-link facebook_share"><img src="{{ asset('frontend/images/blog-list/facebook.webp')}}" alt="facebook"></a>
                      <a href="{{ $followLinks[1]->value }}" target="_blank" class="social-details-link twitter_share" ><img src="{{ asset('frontend/images/blog-list/twitter.webp')}}" alt="twitter"></a>
                      <a href="{{ $followLinks[2]->value }}" target="_blank" class="social-details-link"><img src="{{ asset('frontend/images/blog-list/instragram.webp')}}" alt="instragram"></a>
                       
                        <a href="javascript:void(0);" id="copy-link-button" class="d-none  social-details-link copy-link-button"> <img src="{{ asset('frontend/images/blog-list/instragram.webp')}}" alt="instragram">
                        </a> 
                      <a href="{{ $followLinks[3]->value }}" target="_blank" class="social-details-link linkedin_share"><img src="{{ asset('frontend/images/blog-list/linkedin.webp')}}" alt="linkedin"></a>
                    </li>
                  </ul>
                  <div class="blog-details-table card">
                    <div class="card-header">
                        <h4>Table of Contents</h4>
                    </div>
                    <div class="card-body"> 
                        <div id="toc"> 
                            <ul>
                                @foreach ($headings as $heading) 
                                    <li style="margin-left: {{ ($heading['level'] - 1) * 20 }}px;">
                                        <a href="#{!! $heading['id'] !!}">{!! $heading['text'] !!}</a>
                                    </li>
                                @endforeach 
                            </ul>
                        </div>
                
                    </div>
                </div>
                 {!! $blog_details[0]->body !!}
                </div>
            </div>
            @php
    // Convert the Eloquent collection to an array
    $extra_data_array = $extra_data->toArray();

    // Sort the array by title in ascending order
    usort($extra_data_array, function($a, $b) {
        return strcmp($a['title'], $b['title']);
    });

    $countNum = 0;
@endphp

<div class="blog-details-table card d-none">
    <div class="card-header">
        <h4>Table of Contents</h4>
    </div>
    <div class="card-body"> 
        <div id="toc"> 
            <ul>
                @foreach ($headings as $heading)  
                    @if($heading['text'] != '&nbsp;' && $heading['text'] !="")
                        <li style="margin-left: {{ ($heading['level'] - 1) * 20 }}px;">
                            <a href="#{!! $heading['id'] !!}">{!! $heading['text'] !!}</a>
                        </li>
                    @endif
                @endforeach  
            </ul>
        </div>

    </div>
</div>
 
            @foreach ($extra_data as $key=> $value)
            <div class="details-table-box card">
              <div class="card-header" id="{{ $value->id }}">
                @if ($value->blog_parent == null)
                  <h2>{{ $value->title }}</h2>
                @else
                  <h3>{{ $value->title }}</h3>
                @endif
              </div>
              <div class="card-body">
              {!! $content !!}
              </div>
               <div class="card-image-area">
                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2">
                    @if (!empty($value->image) || !empty($value->image2))
                      <div class="col">
                        @if (!empty($value->image))
                          <figure class="imgBox d-flex">
                            <img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}">
                          </figure>
                        @endif
                      </div>
                      <div class="col">
                        @if (!empty($value->image2))
                          <figure class="imgBox d-flex">
                            <img src="{{ asset('uploads/'.$value->image2) }}" alt="{{ getImageNameAlt($value->image2) }}">
                          </figure>
                        @endif
                      </div>
                    @endif
                  </div>
                </div>
            </div>
            @endforeach

            <div class="blog-details-social2 card">
              <div class="card-body">
                <ul class="social">
                    <li>Social media share :</li>
                    <li><a href="{{ $followLinks[0]->value }}" target="_blank" class="social-link facebook facebook_share"><i class="fa-brands fa-square-facebook"></i>facebook</a></li>
                    <li><a href="{{ $followLinks[1]->value }}" target="_blank" class="social-link twitter twitter_share"><i class="fa-brands fa-twitter"></i>twitter</a></li>
                    <li class=""><a href="{{ $followLinks[2]->value }}" target="_blank" class="social-link instagram"><i class="fa-brands fa-instagram"></i>instagram</a></li>
                    <li  class="d-none">
                        <a href="javascript:void(0);" id="copy-link-button" class="social-link instagram share-button copy-link-button">
                            <i class="fa fa-link"></i> instagram
                        </a>
                    </li>
                    <li><a href="{{ $followLinks[3]->value }}" target="_blank" class="social-link linkedin linkedin_share"><i class="fa-brands fa-linkedin-in"></i>linkedin</a></li>
                </ul>
              </div>
            </div>
            <div class="related-priduct-area">
              <h3><strong>Related Articles :</strong></h3>
              <div class="owl-carousel related-carousel" id="related-slider">
           
                @foreach ($results as $key=>$value)
                  <div class="bolgbox">
                    <div class="bolimg"><img src="{{ asset('uploads/'.$value->image2) }}" alt="{{ getImageNameAlt($value->image2) }}">
                      <div class="btxt">
                        <div class="bicon"><img src="{{ asset('uploads/'.$value->author_image) }}" alt="{{ getImageNameAlt($value->author_image) }}"></div>
                        <div class="stxt">
                          <h5>{{ $value->page_title }}</h5>
                          <h6>{{ $value->bannertext }}</h6>
                        </div>
                      </div>
                    </div>
                    <div class="boltxt">
                      <h4>
                        @if(!empty($value->redirect_to))
                          <a href="{{ url($value->redirect_to) }}">{{ $value->page_name }}</a>
                          @else
                          <a href="{{ url('blog/'.$value->slug) }}">{{ $value->page_name }}</a>
                        @endif
                      </h4>
                      
                      @php
                        $text = $value->body;
                        $limitedContent = substr($text, 0, 150);
                      @endphp
                      {!! $limitedContent !!}
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="related-priduct-area details-Reply-form-box">
              <h3><strong>Enquire Us</strong></h3>
              <form method="post" action="{{ url('blog-comment-form') }}" id="blogContactForm" autocomplete="off">
              <div class="row">
                  @if (session('success_msg'))
                      <div class="alert alert-success">
                        {{ session('success_msg') }}
                      </div>
                  @endif
                  @csrf
                  <input type="hidden" name="page_id" class="form-control" value="{{ $blog_details[0]->id }}">
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                      @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Phone Number<span class="text-danger">*</span></label>
                      <!--<input type="number"  class="form-control" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" name="phone" placeholder="Enter Phone" required>-->
                      <input type="number" class="form-control mobile_code" id="mobile_code" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                      @if ($errors->has('phone'))
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Select Service<span class="text-danger"></span></label>
                        <select class="form-control" name="serviceName">
                            <option value="">Select Service</option>
                            @foreach ($allServiceData as $key=>$value)
                            <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                            @endforeach
                        </select>
                      @if ($errors->has('serviceName'))
                      <span class="text-danger">{{ $errors->first('serviceName') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                      <label>Website Url<span class="text-danger"></span></label>
                      <input class="form-control" name="website_url" placeholder="Type here..."> 
                      @if ($errors->has('website_url'))
                      <span class="text-danger">{{ $errors->first('website_url') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="captcha_box">
                  <div id="html_element" ></div>
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>

                            @elseif ($errors->has('recaptcha_validate'))
                            <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                            @endif
                  </div>
                  <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                    <input type="submit" class="btn-primary mt-3" value="Post Comment" >
                  </div>
                </div>
            </form>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-xxl-4 col-lg-4 col-md-4 position-relative">
          <div class="blog-listing-filter-area sidebar_sticky">
            <div class="blog-listing-form card">
              <div class="card-body">
                <h3>Let’s Contact</h3>
                <form method="post" action="{{ url('blog-form') }}" id="blogForm" autocomplete="off">
                    @csrf
                    @if (session('success'))
                          <div class="alert alert-success">
                            {{ session('success') }}
                          </div>
                    @endif
                    <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
                    <input type="hidden" name="number_new" class="form-control number_new" value="">
                    <div class="form-group">
                      <!--<label>Name*</label>-->
                      <input type="text" class="form-control" name="name" placeholder="Name" required>
                      @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                   
                    <div class="form-group">
                      <!--<label>Phone Number*</label>-->
                      <!--<input type="number" id="mobile_code" class="form-control" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Phone Number" required>-->
                      <input type="number" class="form-control mobile_code" id="mobile_code" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                      @if ($errors->has('phone'))
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                    
                    <div class="form-group select">
                      <!--<label>Select Service</label>-->
                      <select class="form-control" name="serviceName">
                        <option>Select Service</option>
                        @foreach ($allServiceData as $key=>$value)
                          <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('serviceName'))
                      <span class="text-danger">{{ $errors->first('serviceName') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <!--<label>Budget</label>-->
                      <input type="number" class="form-control" name="budget" placeholder="Budget">
                      @if ($errors->has('budget'))
                      <span class="text-danger">{{ $errors->first('budget') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <!--<label>Website Url</label>-->
                      <input type="text" class="form-control" name="website_url" placeholder="Website Url">
                      @if ($errors->has('website_url'))
                      <span class="text-danger">{{ $errors->first('website_url') }}</span>
                      @endif
                    </div>
                    <div class="captcha_box mb-2">
                    <div id="discreetPuzzle" class="g-recaptcha" ></div>
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
            <div class="blog-listing-form blog-listing-category card">
              <div class="card-body">
                <h3>Categories</h3>
                <ul class="blog-filter-list">
                  @foreach ($categoryData as $key=>$catData)
                    <li><a href="{{ url('category/'.$catData->slug) }}">{{ $catData->name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="blog-listing-form blog-listing-category card">
              <div class="card-body">
                <h3>Follow Us on</h3>
                <ul class="follow-on">

                  <li><a href="{{ $followLinks[0]->value }}" target="_blank" class="d-flex align-items-center justify-content-center facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                  <li><a href="{{ $followLinks[1]->value }}" target="_blank" class="d-flex align-items-center justify-content-center twitter"><i class="fa-brands fa-twitter"></i></a></li>
                  <li><a href="{{ $followLinks[3]->value }}" target="_blank" class="d-flex align-items-center justify-content-center linkedin"><i class="fa-brands fa-linkedin-in"></i></a></li>
                  <li><a href="{{ $followLinks[2]->value }}" target="_blank" class="d-flex align-items-center justify-content-center instagram"><i class="fa-brands fa-instagram"></i></a></li>
                    <li class="d-none">
                        <a href="javascript:void(0);" id="copy-link-button" class="social-link instagram share-button copy-link-button d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                </ul>
              </div>
            </div>
            <!--below card display none-->
            <div class="blog-listing-form blog-listing-category service-list card d-none">
              <div class="card-body">
                <h3>Recent Posts</h3>
                <ul class="blog-filter-list">
                  @foreach ($recentPost as $key=>$value)
                     <li><a href="{{ url('blog/'.$value->slug) }}">{{ $value->page_name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="blog-listing-form blog-listing-category service-list card d-none">
              <div class="card-body">
                <h3>Our services</h3>
                <ul class="blog-filter-list">
                  @foreach ($serviceData as $key=>$val)
                  <li><a href="{{ url($val->slug) }}">{{ $val->page_name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="blog-listing-form blog-listing-category card">
              <div class="card-body">
                <h3>Resources</h3>
                <ul class="blog-filter-list">
                  @foreach ($resourceData as $key=>$val)
                  <li><a href="{{ url($val->slug) }}">{{ $val->page_name }}</a></li>  
                  {{--<li><a href="#">{{ $val->page_name }}</a></li>--}}
                  @endforeach
                  <li><a href="https://tools.bebran.com/">Tools</a></li>
                </ul>
              </div>
            </div>
            <!--<div class="blog-listing-form blog-listing-category service-list tab card">-->
            <!--  <div class="card-body">-->

            <!--    <nav class="nav nav-tabs" id="nav-tab" role="tablist">-->
            <!--      <a class="nav-link active"  data-bs-toggle="tab" href="#tab1" role="tab">Recent</a>-->
            <!--      <a class="nav-link"  data-bs-toggle="tab" href="#tab2" role="tab">Category</a>-->
            <!--      <a class="nav-link"  data-bs-toggle="tab" href="#tab3" role="tab">Popular</a>-->
            <!--    </nav>-->
            <!--    <div class="tab-content" id="nav-tabContent">-->
            <!--      <div class="tab-pane fade show active" id="tab1" role="tabpanel">-->
            <!--        <ul class="blog-filter-list">-->
            <!--          @foreach ($recentPost as $key=>$value)-->
            <!--             <li><a href="{{ url('blog/'.$value->slug) }}">{{ $value->page_name }}</a></li>-->
            <!--          @endforeach-->
            <!--        </ul>-->
            <!--      </div>-->
            <!--      <div class="tab-pane fade" id="tab2" role="tabpanel">-->
            <!--        <ul class="blog-filter-list">-->
            <!--          @foreach ($categoryData as $key=>$catData)-->
            <!--            <li><a href="{{ url('category/'.$catData->slug) }}">{{ $catData->name }}</a></li>-->
            <!--          @endforeach-->
            <!--        </ul>-->
            <!--      </div>-->
            <!--      <div class="tab-pane fade" id="tab3" role="tabpanel">-->
            <!--        <ul class="blog-filter-list">-->
            <!--          <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>-->
            <!--          <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>-->
            <!--          <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>-->
            <!--          <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>-->
            <!--          <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>-->
            <!--        </ul>-->
            <!--      </div>-->
            <!--    </div>-->

            <!--  </div>-->
            <!--</div>-->

            <!--below card display none-->
          </div>
        </div>
      </div>
    </div>
  </section>
  @if(!empty($second_title))

  <section class="faqbg" style="background:url({{ asset('frontend/images/faqbg.webp') }}) center no-repeat fixed;">
    <div class="container">
      <div class="headingbox text-center ">
        <h3>@if(!empty($second_title)) {!! $second_title !!}@endif</h3>
      </div>
    </div>
  </section>
  <section class="faqarea position-relative">
    <div class="container">
       <div class="row">
          <div class="col-lg-6">
             <div class="accordion" id="accordionExample">
                @foreach ($extra_data as $key=>$faq)
                <?php //echo "<pre>"; print_r($faq); die;?>
                  @if($faq->type == 3 )
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne">{{ $faq->title }}</button>
                      </h2>
                      <div id="collapseOne{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                    @if($faq->type == 4 )
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
 @endif

@endsection

@section('more-scripts')
 
<script>
  $(document).ready(function() {
      @if (session('success'))
          $('html, body').animate({
              scrollTop: $('#blogForm').offset().top
          }, 1000);
      @endif
  });
  $(document).ready(function() {
      @if (session('success'))
          $('html, body').animate({
              scrollTop: $('#blogContactForm').offset().top
          }, 1000);
      @endif
  });
</script>
<script>
  $(document).ready(function() {
    $('.facebook_share').on('click', function(e) {
      e.preventDefault();
      // Get the URL of the blog you want to share
      var blogURL = '{{ url("blog/".$blog_details[0]->slug) }}';
      var blogTitle = '{{ url("blog/".$blog_details[0]->title) }}';
      // Open the Facebook sharing dialog
      var facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(blogURL);
      window.open(facebookURL, '_blank');
    });
  });
  $(document).ready(function() {
  $('.twitter_share').on('click', function(e) {
    e.preventDefault();
    var blogURL = '<?php echo url("blog/".$blog_details[0]->slug); ?>';
    var blogTitle = '<?php echo $blog_details[0]->title; ?>';
    var twitterURL = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(blogURL) + '&text=' + encodeURIComponent(blogTitle);
    window.open(twitterURL, '_blank');
  });
});
$(document).ready(function() {
  $('.linkedin_share').on('click', function(e) {
    e.preventDefault();

    // Get the URL, title, and description of the blog you want to share
    var blogURL = '<?php echo url("blog/".$blog_details[0]->slug); ?>';
    var blogTitle = '<?php echo $blog_details[0]->title; ?>';

    // Construct the LinkedIn sharing URL
    var linkedinURL = 'https://www.linkedin.com/shareArticle?url=' + encodeURIComponent(blogURL) +
                      '&title=' + encodeURIComponent(blogTitle);

    window.open(linkedinURL, '_blank');
  });
});
  </script>
  <script>
        // Get all elements with class copy-link-button
        var copyButtons = document.querySelectorAll('.copy-link-button');

        // Attach click event listener to each button
        copyButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var dummy = document.createElement('input');
                var text = window.location.href; // You can customize this to get the specific blog post URL
                document.body.appendChild(dummy);
                dummy.value = text;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
                alert('Link copied to clipboard!');
            });
        });
    </script>
@stop


