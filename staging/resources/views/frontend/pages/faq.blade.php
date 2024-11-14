@extends('layouts.app')

@section('content')

<div class="faq-par-sec faq-main-sec gap">
  @if($page->page_title)<div class="title-top1"><div class="container"><h2>{!! $page->page_title !!}</h2></div></div>@endif
  <div class="container">
    {!!$page->body!!}
    <div class="total-faq-wrp">

      <div class="faq-outer-wrp">
        <?php
        $count = 0;
        foreach($extra_data as $val) {
        ?>
        @if($val->type==4)
        <?php
        if ($val->section_type==2) {
          if ($count>0) {
            echo '</div></div><div class="faq-outer-wrp">';
          }
        ?>
        <div class="top-title">
          @if($val->title)<h3>{!!$val->title!!}</h3>@endif
          <div class="minus"><img src="{!! asset('/frontend/images/minus.jpg') !!}"></div>
          <div class="plus"><img src="{!! asset('/frontend/images/plus.png') !!}"></div>
        </div>
        @if($count==0)
        <div class="faq-wrp">
        @endif
        <?php
          if ($count>0) {
            echo '<div class="faq-wrp">';
          }
        }
          $count++;
        ?>
        <?php
        if ($val->section_type==13) {
        ?>
          <div class="faq-blk">
            <div class="faq-title">
              @if($val->title)<h3>{!!$val->title!!}</h3>@endif
              <div class="minus"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
              <div class="plus"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
            </div>
            <div class="faq-des">
              {!!$val->body!!}
            </div>
          </div>

        <?php
        }
        ?>
        @endif
        <?php
        }
        ?>
        </div>
      </div>

    </div>
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
