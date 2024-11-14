@extends('layouts.app')
@section('content')
@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp
    @switch($val->type)
        @case(1)
            @php
              $first_image = $val->image;
              $first_title = $val->title;
              $first_body = $val->body;
            @endphp
          @break
    @endswitch
@endforeach
<div class="thanyou-area">
    <div class="container">
      <div class="thanyoubox">
        <div class="iconthumble">
          {{-- <img src="images/thankicon.png"> --}}
          <img src="{{ asset('uploads/'.$first_image) }}" alt="{{ getImageNameAlt($first_image) }}">
        </div>
        <h2>@if(!empty($first_title)){{ $first_title }} @endif</h2>
        <p>@if(!empty($first_body)){!! $first_body !!} @endif</p>
        <button class="btn-back"><a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left-long"></i> Back Home</a></button>
      </div>
    </div>
  </div>

@endsection
@section('more-scripts')
@stop
