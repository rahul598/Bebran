@extends('layouts.app')
 <style>
.h1_new{
    font-size:70px;
    font-weight:700;
}
.placement{
    width: 80%;
    top: 60%;
    -webkit-transform: translate(0, -50%);
    left: 10%;
    transform: translate(0, -50%);
}
@media(max-width:767px){
    .h1_new{
        font-size:30px !important;
    }
        .placement {
        width: 80%;
        top: 33%;
        -webkit-transform: translate(0, -50%);
        left: 10%;
        transform: translate(0, -50%);
    } 
}
</style>
@section('content')
    
<div class="innerbanner-area"> 
    @foreach ($extra_data as $val)
      @if($val->section_type==1)
            <img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
            <div class="about-area-two-contain position-absolute heading_new placement">
            <h1 class="text-white h1_new ">{{$page->page_name}}</h1> 
        </div>
      @endif
    @endforeach
     <nav class="breadcrumb"> 
      <div class="container">
       <a class="breadcrumb-item" href="{{url('/')}}">home</a> 
       @if($page->page_title)<span class="breadcrumb-item active">{!! $page->page_title !!}</span> @endif
    </div>
    </nav>
  </div>
  
  <section class="innerabout_area">
   <div class="about-area pt-90 pt-0">
    <div class="container">
      @foreach ($extra_data as $val)
        @if($val->section_type==4)
            {!! $val->body !!}
        @endif
      @endforeach
    </div>
  </div>
  </section>
  
@endsection

@section('more-scripts')

@stop


