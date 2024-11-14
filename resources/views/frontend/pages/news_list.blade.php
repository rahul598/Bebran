@extends('layouts.app')

@section('content')
  @foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp
      @if ($val->type == 1)
        @php $image = $val->image; @endphp
      @endif
  @endforeach
<style>
.heading_new{
    top: 40%; 
    left: 30%; 
    transform: translate(-50%, -50%);
}
.h1_new{
    font-size: 70px;
    color: #fff;
}
@media(max-width:767px){
    .heading_new{
        top: 32%;
        left: 50%;
    }
    .h1_new{
            font-size: 40px;
    }
}
</style>
<div class="innerbanner-area position-relative">
      @if (!empty($image))
        <img src="{{ asset('uploads/'.$image) }}" alt="{{ getImageNameAlt($image) }}" class="banner_image_new"> 
        <div class="about-area-two-contain position-absolute heading_new">
            <h1 class="h1_new">{{(isset($page->page_title)?$page->page_title:"News")}}</h1> 
        </div>
      @else
        <img src="{{ asset('frontend/images/be-bran-innerbanner3.webp') }}" alt="be-bran-innerbanner3">
      @endif
  <nav class="breadcrumb">
    <div class="container">
      <a class="breadcrumb-item" href="{{url('/')}}">home</a>
      <span class="breadcrumb-item active">News List</span>
    </div>
  </nav>
</div>
<section class="inner-blog-list-area">
  <div class="container">
    <div class="row">
      @if (!$newsData->isEmpty())
      <div class="col-lg-8 col-md-8">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2">
          @foreach ($newsData as $key=>$val)
            <div class="col">
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
                  <h4><a href="{{ url('news/'.$val->slug) }}">{{ $val->page_name }}</a></h4>
                  @php
                  $text = $val->body;
                  $limitedContent = substr($text, 0, 150);
                  @endphp
                  <p>@if($limitedContent){!! strip_tags($limitedContent, '<p></p>').'...' !!}@else {!! $limitedContent !!} @endif</p>
                  <a href="{{ url('news/'.$val->slug) }}" class="btn btn-primary">read more</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="pagination-box d-flex justify-content-center pt-3">
            <nav aria-label="page navigation">
                <ul class="pagination pagination-sm">
                    <li class="page-item {{ $currentPage === 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="@if(!empty($slugData))
                        {{ $currentPage > 1 ? url('news-category/'.$slugData.'?page='.($currentPage - 1)) : '#' }}
                        @else
                        {{ $currentPage > 1 ? url('news-list?page='.($currentPage - 1)) : '#' }}
                        @endif
                        ">Previous</a>
                    </li>
                    @for ($pageData = 1; $pageData <= $totalPages; $pageData++)
                        <li class="page-item {{ $currentPage == $pageData ? 'active' : '' }}">
                            <a class="page-link" href="@if(!empty($slugData))
                            {{ url('news-category/'.$slugData.'?page='.$pageData) }}
                            @else
                            {{ url('news-list?page='.$pageData) }}
                            @endif
                            ">{{ $pageData }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $currentPage === $totalPages ? 'disabled' : '' }}">
                        <a class="page-link" href="@if(!empty($slugData))
                        {{ $currentPage < $totalPages ? url('news-category/'.$slugData.'?page='.($currentPage + 1)) : '#' }}
                        @else
                        {{ $currentPage < $totalPages ? url('news-list?page='.($currentPage + 1)) : '#' }}
                        @endif
                        ">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
      </div>
        @else
          <div class="col-lg-8 col-md-8">
            <p class="text-center"> There is no posted News at this moment</p>
          </div>
        @endif
      <div class="col-lg-4 col-md-4">
        <div class="blog-listing-filter-area">
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
                <input type="hidden" name="country_code" class="form-control country_code" value="">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Name" required>
                  @if ($errors->has('name'))
                  <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
               
                <div class="form-group">
                  <!--<input type="number" class="form-control" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Phone Number" required>-->
                  <input type="number" class="form-control mobile_code" id="mobile_code" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                  @if ($errors->has('phone'))
                  <span class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
                </div>
                
                <div class="form-group select">
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
                <div class="form-group">
                  <input type="number" class="form-control" name="budget" placeholder="Budget">
                  @if ($errors->has('budget'))
                  <span class="text-danger">{{ $errors->first('budget') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="website_url" placeholder="Website Url">
                  @if ($errors->has('website_url'))
                  <span class="text-danger">{{ $errors->first('website_url') }}</span>
                  @endif
                </div>
                <div class="captcha_box mb-2" >
                <div id="html_element" class="g-recaptcha"></div>
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
                  {{-- <li><a href="{{ url($catData->slug) }}">{{ $catData->name }}</a></li> --}}
                  <li><a href="{{ url('news-category/'.$catData->slug) }}">{{ $catData->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="blog-listing-form blog-listing-category card">
            <div class="card-body">
              <h3>Follow Us on</h3>
              <ul class="follow-on">
                <li><a href="{{ $followLinks[0]->value }}" target="_blank" class="d-flex align-items-center justify-content-center facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="{{ $followLinks[3]->value }}" target="_blank" class="d-flex align-items-center justify-content-center instagram"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="{{ $followLinks[1]->value }}" target="_blank" class="d-flex align-items-center justify-content-center twitter"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="{{ $followLinks[2]->value }}" target="_blank" class="d-flex align-items-center justify-content-center linkedin"><i class="fa-brands fa-linkedin-in"></i></a></li>
                
              </ul>
            </div>
          </div>

          <div class="blog-listing-form blog-listing-category service-list card">
            <div class="card-body">
              <h3>Recent Posts</h3>
              <ul class="blog-filter-list">
              @foreach ($recentPost as $key=>$val)
                <li><a href="{{ url('news/'.$val->slug) }}">{{ $val->page_name }}</a></li>
              @endforeach
              </ul>
            </div>
          </div>

          <div class="blog-listing-form blog-listing-category service-list card">
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
                {{-- <li><a href="#">{{ $val->page_name }}</a></li> --}}
                @endforeach
                <li><a href="https://tools.bebran.com/">Tools</a></li>
                
              </ul>
            </div>
          </div>
        </div>
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
              scrollTop: $('#blogForm').offset().top
          }, 1000);
      @endif
  });
</script>
@stop


