@extends('layouts.app')
@section('content') 
      @foreach ($extra_data as $val)
          @if($val->type==1)
              @php 
                $first_title = $val->title; 
                $first_sub_title = $val->sub_title; 
                $first_image = $val->image; 
                $first_body = $val->body; 
                $first_btn_text = $val->btn_text; 
              @endphp
          @endif
      @endforeach
      <div class="thanksection">
         <div class="container">
            <div class="thankarea">
            <div class="thankimg">
                @if (file_exists(public_img_path($first_image)))
                <img src="{{ asset('uploads/' . $first_image) }}" alt="{{ getImageNameAlt($first_image) }}">
                @else
                    Image not found
                @endif
            </div>
            <h1 style="font-size:40px;">{!! $first_title !!}</h1>
            <h5>{!! $first_sub_title !!}</h5>
            <p>{!! $first_body !!}</p>
            <a href="{{ url('/') }}" class="btn-primary">{{ $first_btn_text }}</a>
            <ul>
               <li><a href="{{ $followLinks[0]->value }}" target="_blank"><img src="{{ asset('frontend/images/tyfacebook.webp') }}" alt="facebook"></a></li>
               <li><a href="{{ $followLinks[2]->value }}" target="_blank"><img src="{{ asset('frontend/images/tylinkdin.webp') }}" alt="linkedin"></a></li>
               <li><a href="{{ $followLinks[1]->value }}" target="_blank"><img src="{{ asset('frontend/images/tytwitter.webp') }}" alt="twitter"></a></li>
            </ul>
         </div>
         </div>
      </div>
@endsection      
     