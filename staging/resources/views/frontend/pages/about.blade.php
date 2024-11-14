@extends('layouts.app')
@section('content')
@foreach ($extra_data as $val)
   @if($val->type==1)
      @php $image = $val->image; @endphp
   @elseif($val->type==2)
      @php
        $title = $val->title;
        $body = $val->body;
      @endphp
   @elseif($val->type==3)
      @php
        $second_title = $val->title;
        $sub_title = $val->sub_title;
        $image_two = $val->image;
        $second_body = $val->body;
      @endphp
   @elseif($val->type==4)
      @php
         $third_title = $val->title;
      @endphp
   @elseif($val->type==7)
      @php
         $fourth_title = $val->title;
         $fourth_body = $val->body;
         $btn_text = $val->btn_text;
         $btn_url = $val->btn_url;
      @endphp
   @elseif($val->type==8)
     @php
        $fifth_title = $val->title;
        $fifth_image = $val->image;
        $fifth_body = $val->body;
     @endphp
   @elseif($val->type==9)
      @php
         $sixth_title = $val->title;
         $sixth_image = $val->image;
         $sixth_body = $val->body;
      @endphp                    
   @endif
@endforeach
<div class="innerbanner-area">
   @foreach ($extra_data as $val)
      @if($val->type==1)
         <img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
      @endif
   @endforeach

   <nav class="breadcrumb">
      <div class="container">
         <a class="breadcrumb-item" href="{{url('/')}}">home</a> 
         <span class="breadcrumb-item active">{{ $page->page_name}}</span> 
      </div>
   </nav>
</div>
<section class="innerabout_area">
   <div class="about-area pt-90">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xxl-6 col-lg-6 col-md-6">
               @foreach ($extra_data as $val)
                  @if($val->type==2)
                     <div class="about-imgbox"> <img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}"> </div>
                  @endif
               @endforeach
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-6">
               <div class="webtext">
                  <h2>{!! $title !!}</h2>
                     {!! $body !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="about-area abouttwo pt-90">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xxl-6 col-lg-6 col-md-6 order-2">
      
               <div class="about-imgbox"> <img src="{{ asset('uploads/'.$image_two) }}" alt="{{ getImageNameAlt($image_two) }}"> </div>
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-6 order-1">
               <div class="webtext">
                  <h2>{{ $second_title }}<strong>{!! $sub_title !!}</strong></h2>
                  {!! $second_body !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   <!------------old code---------->
   <div class="strength d-none" style="background:url({{ asset('frontend/images/strengthbg.webp')}}) center no-repeat fixed">
      <div class="container">
         <div class="headingbox text-center">
            <h3>{!! $third_title !!}</h3>
         </div>
         <ul>
            @foreach ($extra_data as $val)
               @if($val->type == 5)
                  <li>
                     <div class="ourbox">
                        <div class="ourimg"><img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}"></div>
                        <h4>{{ $val->title }}</h4>
                        <h6>{{ $val->sub_title }}</h6>
                     </div>
                  </li>
                @endif
            @endforeach
         </ul>
      </div>
   </div>
   <!------------old code---------->
    <!-------------- Our Strength-------------->
    @include('frontend.fix-widgets.our_strength')
    <!-------------- Our Strength-------------->
   
   <div class="whyus_area">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-5 col-md-5 order-2">
               <div class="whyus_area_left">
                  <div class="headingbox">
                     <h3>{!! $fourth_title !!}</h3>
                  </div>
                  <div>{!! $fourth_body !!}</div>
                  <a href="{{ $btn_url }}" class="btn-primary">{{ $btn_text }}</a>
               </div>
            </div>
            <div class="col-lg-7 col-md-7 order-1">
               <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2">
                  @foreach ($extra_data as $val)
                     @if($val->type == 6)
                  
                        <div class="col">
                           <div class="card">
                              <div class="icon">
                                 <img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                              </div>
                              <h4>{{ $val->title }}</h4>
                              <div>{!! $val->body !!}</div>
                           </div>
                        </div>
                     @endif
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="about-area aboutthree pt-90">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xxl-6 col-lg-6 col-md-6 order-2">
               <div class="about-imgbox"> <img src="{{ asset('uploads/'.$fifth_image) }}" alt="{{ getImageNameAlt($fifth_image) }}"> </div>
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-6 order-1">
               <div class="webtext">
                  <h3>{!! $fifth_title !!}</h3>
                  {!! $fifth_body !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="about-area aboutfore pt-90">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-xxl-6 col-lg-6 col-md-6">
               <div class="about-imgbox"> <img src="{{ asset('uploads/'.$sixth_image) }}" alt="{{ getImageNameAlt($sixth_image) }}"> </div>
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-6">
               <div class="webtext">
                  <h3>{!! $sixth_title !!}</h3>
                     {!! $sixth_body !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
@section('more-scripts')

@stop