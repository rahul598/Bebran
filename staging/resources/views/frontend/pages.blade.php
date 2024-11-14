@extends('layouts.app')

@section('content')

<div class="about-sec">
  <div class="container">
      @if($page->page_title)<h2>{!! $page->page_title !!}</h2>@endif
      {!!$page->body!!}
  </div>
</div>

@include('frontend.inc.footer_common',['extra_data'=> $extra_data])

@endsection

@section('more-scripts')

<script>
$(document).ready(function() { 
});
</script>
@stop
