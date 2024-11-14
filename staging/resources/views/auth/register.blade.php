@extends('layouts.app')

@section('content')
<?php
$privacy = get_page(Privacy_Policy_ID);
$term = get_page(Terms_Conditions_ID);
?>
<div class="bg-wrp profile">
    <div class="inner-form-sec profile-sec pad">
        <div class="container ">
            <h3 class="text-center">Register</h3>
            <p class="text-center">Please create your account.</p>
            @include('frontend.inc.message') 
            <div class="contact-form inner-cnt-form"> 
            <form method="POST" action="{{ route('register') }}" class="customValidate">
                @csrf
                <label>Full Name</label>
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter your full name" autofocus>

                <div class="d-flex flex-wrap justify-content-between">
                    <div class="in-lft">
                        <label>Email</label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">
                    </div>
                    <div class="in-rgt">
                        <label>Re-enter Email</label>
                        <input type="text" class="@error('email_confirmation') is-invalid @enderror" name="email_confirmation" value="" data-rule-equalTo="#email" autocomplete="off" placeholder="Re-enter your email address">
                    </div>
                </div> 
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="in-lft">
                        <label>Password</label>
                        <div class="pass"><input id="password" type="password" class="password @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"><div class="ey"><i id="eye_gpass" class="fa fa-eye-slash"></i></div></div>
                    </div>
                    <div class="in-rgt">
                        <label>Confirmation Password</label>
                        <div class="pass"><input id="password_confirmation" type="password" class="password @error('password') is-invalid @enderror" name="password_confirmation" data-rule-equalTo="#password" autocomplete="new-password"><div class="ey"><i id="eye_gpass" class="fa fa-eye-slash"></i></div></div>
                    </div>
                </div>
              <div class="checkbox-sec">

                <div class="radio-sec justify-content-between">
                  <label class="clb">Agree to the @if($privacy)<a href="{{url($privacy->slug)}}" target="_blank">{!!$privacy->page_name!!}</a>@endif {{$privacy && $term?'&':''}} @if($term)<a href="{{url($term->slug)}}" target="_blank">{!!$term->page_name!!}</a>@endif
                    <input type="checkbox" name="aggrement" value="1" required>
                    <span class="checkmark"></span>
                  </label>

                </div>
              </div>
                <input type="submit" value="Sign in">
                <div class="btm-txt">Already have an account? <span><a href="{{ route('login') }}">Sign in</a></span></div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('more-scripts')
<script>

$(document).ready(function(){
    $(".chk-d").trigger("click");
});
</script>
<script>
    $(function() {
  $('.ps input').on("input", function() {
    $('#someDiv').text($(this).val());
  });
});
</script>
@stop
