@extends('layouts.app')
@section('content')
      @foreach ($extra_data as $val)
          @if($val->type==1)
              @php 
                $first_title = $val->title; 
                $first_sub_title = $val->sub_title; 
              @endphp
          @endif
          @if($val->type==2)
              @php 
                $second_image = $val->image; 
                $second_body = $val->body; 
                $second_btn_text = $val->btn_text; 
                $second_btn_url = $val->btn_url; 
              @endphp
          @endif
      @endforeach
      <div class="signupsection">
        <div class="container">
           <h1 style="font-size:40px;" class="text-center">@if(!empty($first_title)){!! $first_title !!}@endif</h1>
           <h5>@if(!empty($first_sub_title)){!! $first_sub_title !!}@endif</h5>
           <div class="signupbox">
              <div class="row align-items-center">
                 <div class="col-lg-7">
                    <p>@if(!empty($second_body)){!! $second_body !!}@endif </p>
                    <a href="{{ url($second_btn_url) }}" class="btn-primary">@if(!empty($second_btn_text)){!! $second_btn_text !!}@endif </a>
                 </div>
                 <div class="col-lg-5">
                    <div class="thankimg">
                        @if (file_exists(public_img_path($second_image)))
                        <img src="{{ asset('uploads/' . $second_image) }}" alt="{{ getImageNameAlt($second_image) }}">
                        @else
                            Image not found
                        @endif
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
@endsection      
     