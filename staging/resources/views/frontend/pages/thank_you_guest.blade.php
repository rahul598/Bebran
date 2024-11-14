@extends('layouts.app')
@section('content')
      @foreach ($extra_data as $val)
          @if($val->type==1)
              @php 
                $first_title = $val->title; 
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
            <h4>{!! $first_title !!}</h4>
            <h5>{!! $first_body !!} </h5>
            <a href="{{ url('/') }}" class="btn-primary">{!! $first_btn_text !!}</a>
         </div>
         </div>
      </div>
@endsection      
     
      