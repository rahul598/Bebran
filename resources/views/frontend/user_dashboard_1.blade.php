@extends('layouts.app')
@section('more-css') 
<style>
.dash{
    background-color: #181e4e;
}
</style>
<style>
:root {
  /* fonts */
  --font-montserrat: Montserrat;

  /* font sizes */
  --font-size-3xs: 10px;
  --font-size-xs: 12px;
  --font-size-xl: 20px;
  --font-size-lg: 18px;
  --font-size-5xs: 8px;

  /* Colors */
  --color-white: #fff;
  --color-darkslateblue-100: #5966b8;
  --color-darkslateblue-200: #343f92;
  --color-darkslateblue-300: #181e4e;
  --color-darkslateblue-400: rgba(24, 30, 78, 0.2);
  --color-darkslateblue-500: rgba(24, 30, 78, 0.18);
  --color-gainsboro: #e6e6e6;
  --color-black: #000;
  --color-ghostwhite: #eef0fd;
  --color-gold-100: #facc16;
  --color-gold-200: rgba(250, 204, 22, 0.24);
  --color-gray: #0b0b0b;
  --color-darkorange: #ff7700;
  --color-honeydew: #dff5e8;
  --color-aquamarine: #84e4ab;

  /* Gaps */
  --gap-5xs: 8px;
  --gap-8xs: 5px;
  --gap-4xs: 9px;
  --gap-smi: 13px;
  --gap-10xs: 3px;
  --gap-xl: 20px;
  --gap-8xl: 27px;
  --gap-9xs: 4px;
  --gap-12xs: 1px;

  /* Paddings */
  --padding-9xl: 28px;
  --padding-4xs: 9px;
  --padding-12xl: 31px;
  --padding-5xs: 8px;
  --padding-xl: 20px;
  --padding-mid: 17px;
  --padding-sm: 14px;
  --padding-54xl: 73px;
  --padding-4xl: 23px;
  --padding-10xs: 3px;
  --padding-9xs: 4px;
  --padding-19xl: 38px;
  --padding-11xs: 2px;
  --padding-8xs: 5px;
  --padding-base: 16px;
  --padding-lg: 18px;
  --padding-17xl: 36px;
  --padding-smi: 13px;
  --padding-7xs: 6px;
  --padding-12xs: 1px;
  --padding-6xs: 7px;
  --padding-3xs: 10px;

  /* Border radiuses */
  --br-mini: 15px;
  --br-7xs: 6px;
  --br-8xs: 5px;
  --br-xl: 20px;
}
 .border-new {
    border: 1px solid lightgrey;
    padding: 5px;
    border-radius: 10px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #000 !important;
    background-color: #eef0fd !important;
}
.duration {
    text-align: center;
    padding: var(--padding-5xs) var(--padding-base);
    line-height: 15px;
}
@media screen and (max-width: 750px) {
  .digital-marketing-packages {
    font-size: 24px;
  }
}
@media screen and (max-width: 675px) {
  .box-bronze-parent {
    gap: 18px;
  }
  .macbook-air-1 {
    gap: 16px;
    padding-left: 30px;
    padding-right: 27px;
    box-sizing: border-box;
  }
}
@media screen and (max-width: 450px) {
  .digital-marketing-packages {
    font-size: var(--font-size-lg);
  }
  .subscription-options {
    flex-wrap: wrap;
  }
  .box-bronze,
  .box-gold,
  .box-platinum,
  .box-silver {
    padding-top: var(--padding-xl);
    padding-bottom: var(--padding-xl);
    box-sizing: border-box;
    margin-bottom: 15px;
  }
  .box-silver {
    gap: var(--gap-xl);
  }
  .box-platinum {
    gap: 22px;
  }
}
.display_none{
    display:none !important;
}
.border-new{
    border: 1px solid lightgrey;
    padding: 5px;
    border-radius: 10px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
    color: #000 !important;
    background-color: #eef0fd !important;
}
.sub_title{
    font-size: var(--font-size-3xs-1);
    
}
@media(max-width:767px){
    .tab-content .tab-pane{
        flex-direction: column;
        align-items: center;
    }
}

.nav-pills-custom .nav-link {
    color: #aaa;
    background: #fff;
    position: relative;
}

.nav-pills-custom .nav-link.active {
    color: #45b649;
    background: #fff;
}


/* Add indicator arrow for the active tab */
@media (min-width: 992px) {
    .nav-pills-custom .nav-link::before {
        content: '';
        display: block;
        border-top: 8px solid transparent;
        border-left: 10px solid #fff;
        border-bottom: 8px solid transparent;
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        opacity: 0;
    }
}

.nav-pills-custom .nav-link.active::before {
    opacity: 1;
}
.h4{
    background: #facc15;
    border-radius: 10px;
    padding: 10px;
}
 
</style>
@endsection
@section('content') 
<section class="container mt-5 pt-5 ">
   <div class="row">
      <div class="col-md-10  m-auto">
         <div class="  p-4  ">
            <div class="card-body">
               <h6 class="dash text-white p-4 rounded">Dashboard</h6>
               <!-- Demo header-->
<section class="py-5 header">
    <div class="container py-4"> 
        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-bs-toggle="tab" href="#v-pills-home" role="tab" aria-controls="#v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Personal information</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-bs-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="#v-pills-profile" aria-selected="false">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Subscription</span></a> 
                    <a class="nav-link mb-3 p-3 shadow"   href="{{ route('user_logout')}}"  >
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Logut</span></a> 
                    </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4 h4">Personal information</h4>
                        <?php  $user = session()->get('client_data'); ?>
                       <form class="row" action="https://geniusdevs.com/codecanyon/omnimart40/user/profile/update" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label for="account-fn">First Name</label>
                                    <input class="form-control" name="first_name" type="text" id="account-fn" value="{{ $user->first_name}}" readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account-ln">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" id="account-ln" value="{{ $user->last_name}}" readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="account-email">Email</label>
                                    <input class="form-control" name="email" type="email" id="account-email" value="{{ $user->email}}" readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group">
                                    <label for="account-phone">Registered Mobile Number</label>
                                    <input class="form-control" name="phone" type="text" id="account-phone" value="{{ $user->phone }}" readonly disabled>
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group">-->
                            <!--        <label for="account-pass">New Password</label>-->
                            <!--        <input class="form-control" name="password" type="text" id="account-pass" placeholder="Change your password" readonly> -->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-12">-->
                            <!--    <hr class="mt-2 mb-3">-->
                            <!--    <div class="d-flex flex-wrap justify-content-between align-items-center">-->
                            <!--    <div class="custom-control custom-checkbox d-block">-->
                            <!--        <input class="custom-control-input" name="newsletter" type="checkbox" id="subscribe_me" checked="">-->
                            <!--        <label class="custom-control-label" for="subscribe_me">Subscribe</label>-->
                            <!--    </div>-->
                            <!--    <button class="btn btn-primary margin-right-none" type="submit"><span>Update Profile</span></button>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </form>
                    </div>
                    
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="font-italic mb-4 h4">Subscription</h4>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Duration</th>
                              <th scope="col">Plan Name</th>
                              <th scope="col">Service Name</th> 
                            </tr>
                          </thead>
                          <tbody> 
                            @foreach($plan_details as $val)
                                @php
                                    $service_names = DB::table('pages')
                                    ->where('id', $val->service_type)
                                    ->first();
                                @endphp
                                <tr>
                                    <td>{{ $val->plan_duration }}</td>
                                    <td>{{ $val->plan_name }}</td>
                                    <td>{{ $service_names->page_name }}</td>
                                </tr>
                            @endforeach

                          </tbody>
                        </table> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>

            </div>
         </div>
      </div>
   </div>
</section>
@endsection