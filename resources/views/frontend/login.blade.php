@extends('layouts.app')
@section('more-css') 
<style>
    .padding-bottom-3x {
    padding-bottom: 72px !important;
}
.margin-bottom-1x {
    margin-bottom: 24px !important;
}
.card-body{
    flex: 1 1 auto !important;
    padding: 1rem 1rem !important;
}
.card {
    border-radius: 10px;
    border: 0;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}
.form-control:not(textarea), select.form-control:not([size]):not([multiple]) {
    height: 46px;
}
.form-group, .order-table, .review-area .section-title, .shopping-cart, .wishlist-table {
    margin-bottom: 20px !important;
} 
.padding-bottom-1x {
    padding-bottom: 24px !important;
}
</style>
@endsection
@section('content')
<div class="container padding-bottom-3x mb-1">
  <div class="row mt-5 pt-5">
          <div class="col-md-6">
            <form class="card" method="post" action="{{ route('client.login') }}">
                @csrf             
                <div class="card-body">
                <h4 class="margin-bottom-1x text-center">Login</h4>

                <div class="form-group input-group">
                  <input class="form-control" type="email" name="login_email" placeholder="Email" value="">
                  <span class="input-group-addon"><i class="icon-mail"></i></span>
                </div>
                
                <div class="form-group input-group">
                  <input class="form-control" type="password" name="login_password" placeholder="Password"><span class="input-group-addon"><i class="icon-lock"></i></span>
                </div>
                
                <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="remember_me">
                    <label class="custom-control-label" for="remember_me">Remember me</label>
                  </div><a class="navi-link" href="https://geniusdevs.com/codecanyon/omnimart40/user/forgot">Forgot password?</a>
                </div>
                <div class="text-center">
                  <input type="submit"  class="btn btn-primary margin-bottom-none" name="submit" value="Login" > 
                </div> 
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <div class="card register-area">
                <div class="card-body ">
                    <h4 class="margin-bottom-1x text-center">Register</h4>
            <form class="row" action="{{ route('user.register') }}" method="POST">
                @csrf                 
                <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-fn">First Name</label>
                  <input class="form-control" type="text" name="first_name" placeholder="First Name" id="reg-fn" value="">
                                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-ln">Last Name</label>
                  <input class="form-control" type="text" name="last_name" placeholder="Last Name" id="reg-ln" value="">
                                  </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-email">E-mail Address</label>
                  <input class="form-control" type="email" name="email" placeholder="E-mail Address" id="reg-email" value="">
                                  </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-phone">Phone Number</label>
                  <input class="form-control mobile_code" name="phone" type="text" placeholder="Phone Number" id="reg-phone" value="">
                  <!--<input type="text" id="mobile_code" class="form-control" placeholder="Phone Number" name="name">-->
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Password</label>
                  <input class="form-control" type="password" name="password" placeholder="Password" id="reg-pass">
                                  </div>

              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass-confirm">Confirm Password</label>
                  <input class="form-control" type="text" name="password_confirmation" placeholder="Confirm Password" id="reg-pass-confirm">
                </div>
              </div> 
              
              <div class="col-12 text-center">
                <input class="btn btn-primary margin-bottom-none" type="submit" value="Register" name="register"> 
              </div>
            </form>
                </div>
            </div>
          </div>
        </div>
  </div>
@endsection
@section('more-js')
<script>
$(document).ready(function(){
    // -----Country Code Selection
    $(".mobile_code").intlTelInput({
    	initialCountry: "in",
    	separateDialCode: true,
    	// utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
    });
});
</script>
@endsection