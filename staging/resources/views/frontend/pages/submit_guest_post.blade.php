@extends('layouts.app')
@section('content')
    @foreach ($extra_data as $val)
        @if($val->type==1)
            @php $first_title = $val->title; @endphp
        @elseif($val->type==2)
            @php
                $second_body = $val->body;
            @endphp
        @endif
    @endforeach
<style>
    .content_box_new ul li{
        list-style-type:disc;
    }
    .blog-details-box1 .content_box_new h1,.blog-details-box1 .content_box_new h2, .blog-details-box1 .content_box_new h3, .blog-details-box1 .content_box_new h4, .blog-details-box1 .content_box_new h5, .blog-details-box1 .content_box_new h6{
        padding: 10px 0 !important;
    }
</style>
 <div class="innerbanner-area">
     @php 
        $new_image = []; 
        foreach($extra_data as $key_new => $new_value){
            $new_image[] = $new_value['image'];
        } 
     @endphp
   @if (!empty($new_image[0]))
   @php
       $imagePath = 'uploads/'.$new_image[0]; 
       $imageName = pathinfo($imagePath, PATHINFO_FILENAME);
       $imageAlt = substr($imageName, strpos($imageName, '_') + 1);
       
   @endphp
   <img src="{{ asset('uploads/'.$new_image[0]) }}" alt="{{ $imageAlt }}" class="banner_image_new">
   @else
   <img src="{{ asset('frontend/images/be-bran-innerbanner4.webp')}}" alt="be-bran-innerbanner4" class="banner_image_new">
   @endif
   <!--<nav class="breadcrumb">-->
   <!--   <div class="container">-->
   <!--      <a class="breadcrumb-item" href="#">home</a>-->
   <!--      <a class="breadcrumb-item" href="#">blog</a>-->
   <!--      <span class="breadcrumb-item active">How to give a better feedback</span>-->
   <!--   </div>-->
   <!--</nav>-->
</div> 
<section class="inner-blog-list-area">
   <div class="innerbanner-area">
      <nav class="breadcrumb">
         <div class="container">
         <a class="breadcrumb-item" href="{{url('/')}}">home</a>
         <span class="breadcrumb-item active">{{ $page->page_title}}</span>
         </div>
      </nav>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-xxl-12 col-xxl-12 col-lg-12 col-md-12">
            <div class="blog-details-box-area">
               <div class="blog-details-box1 card">
                  <div class="card-body content_box_new">
                     <h2>{{ $page->page_title }}</h2>
                     @if(!empty($second_body))
                     {!! $second_body !!}
                     @endif
                  </div>
               </div>

               <div class="related-priduct-area details-Reply-form-box">
                  <h3><strong>Leave a Reply :</strong></h3>
                  <div class="row">
                    <form method="post" action="{{ url('guest-form') }}" id="guestForm" autocomplete="off">
                        @csrf
                        @if (session('success'))
                                <div class="alert alert-success">
                                {{ session('success') }}
                                </div>
                        @endif
                        <input type="hidden" name="number_new" class="form-control number_new" value="">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label>Post Title<span class="text-danger">*</span></label>
                            <input type="text" name="post_title" class="form-control" placeholder="Enter Post Title">
                            @if ($errors->has('post_title'))
                            <span class="text-danger">{{ $errors->first('post_title') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label>Author Name<span class="text-danger">*</span></label>
                            <input type="text" name="author_name" class="form-control" placeholder="Author Name">
                            @if ($errors->has('author_name'))
                            <span class="text-danger">{{ $errors->first('author_name') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label>Email Address<span class="text-danger">*</span></label>
                            <input type="email" name="email_address" class="form-control" placeholder="Email Address">
                            @if ($errors->has('email_address'))
                            <span class="text-danger">{{ $errors->first('email_address') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label>Phone Number<span class="text-danger">*</span></label>
                            <!--<input type="number" name="guest_mobile" class="form-control" placeholder="Phone Number">-->
                            <input type="number" class="form-control mobile_code" id="mobile_code" name="guest_mobile" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                            @if ($errors->has('guest_mobile'))
                            <span class="text-danger">{{ $errors->first('guest_mobile') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="form-group">
                            <label>Post Content brief<span class="text-danger">*</span></label>
                            <textarea class="form-control " name="post_content" placeholder="Type here..."></textarea>
                            @if ($errors->has('post_content'))
                            <span class="text-danger">{{ $errors->first('post_content') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="captcha_box mb-2">
                            <div id="discreetPuzzle" class="mt-2"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    
                                    @elseif ($errors->has('recaptcha_validate'))
                                    <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                                    @endif
                            </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                            <input type="submit" class="btn-primary mt-3" value="Request for Guest Post" >
                        </div>
                    </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection