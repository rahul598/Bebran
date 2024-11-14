@extends('layouts.app')
@section('more-css') 
<style>
   .sticky-aside {
   position: -webkit-sticky; /* For Safari */
   position: sticky;
   top: 20px; /* Adjust this value as needed */
   }
   .jurney .label_head{
   width: 100%;
   background: #181e4e;
   color: #fff;
   padding: 5px;
   border-radius: 5px;
   font-size:13px;
   }
</style>
@endsection
@section('content') 
<section class="container mt-5 pt-5">
   <div class="row">
      <div class="col-md-3">
         <aside class="sticky-aside">
            <div class="shadow rounded" style='border-radius:10% !important;'>
               <div class="card">
                  <div class="card-body">
                     <div class="text-center" style="background-color: lightgrey;    border-top-left-radius: 30px; padding: 20px 0; border-top-right-radius: 30px;">
                        <img src="{{ asset('frontend/images/true_check/server.png') }}" width="30%">
                     </div>
                     <div class="p-4">
                        <?php $main_service = DB::table('pages')->where('id', $_GET['main_service'])->first(); ?>
                        <h5 class="card-title pb-2" style="color: #181e4e;font-weight:700;">{{ $main_service->page_name}}</h5>
                        <label>Plan Name</label>
                        <h6 class="card-subtitle mb-2 text-muted pt-1 plan_name">{{$_GET['package_plan']}}</h6>
                        <label>Duration</label>
                        <p class="card-text text-muted mb-2 plan_duration_name">{{$_GET['plan_duration']}}</p>
                        <label>Total Price</label>
                        <p class="card-text text-warning plan_duration_name" style="font-size:22px;font-weight:700;">Rs {{ number_format($_GET['order_price'])}}</p>
                     </div>
                  </div>
               </div>
            </div>
         </aside>
      </div>
      <div class="col-md-8 jurney">
         <div class="shadow p-4 rounded">  
            <form action="{{ route('cart.add') }}" method="GET">
                <input type="hidden" class="form-control" name="service_main" value="{{ $_GET['main_service'] }}">
                <input type="hidden" class="form-control" name="package_plan" value="{{ $_GET['package_plan'] }}">
                <input type="hidden" class="form-control" name="plan_duration" value="{{ $_GET['plan_duration'] }}">
                <input type="hidden" class="form-control" name="addon_service" value="{{ isset($_GET['addon_service']) ? $_GET['addon_service'] : '' }}">
                <input type="hidden" class="form-control" name="order_price" value="{{ number_format($_GET['order_price'])}}">
            <div class="mt-3">
               <div class="mb-3">
                  <label class="mb-3 mt-3 label_head">Website Or Domain</label> 
                  <input type="text" class="form-control" name="website">
               </div>
               <div class="mb-3"> 
                  <label for="exampleFormControlTextarea1" class="form-label  label_head mb-3 mt-3">Competitor</label>
                  <textarea class="form-control" name="competitor" id="exampleFormControlTextarea1" rows="3" style="resize: auto !important;"></textarea>
               </div>
            </div>
            <?php
              $user = session('client_data');
              $userArray = json_decode(json_encode($user), true); 
               ?>
            @if(!empty($userArray))
            <button type="submit" class="card-link btn btn-primary">Add To Cart</button>
            @else
            <div class="d-flex justify-content-end">
                <div>
                    <a href="{{ route('user.login', [
                    'returnUrl' => url()->current() . '?order_price=' . request()->get('order_price') . '&package_plan=' . request()->get('package_plan') . '&plan_duration=' . request()->get('plan_duration') . '&main_service=' . request()->get('main_service') . '&addon_service=' . request()->get('addon_service')
                ]) }}" id="nextStepLink" class="card-link btn btn-primary">Sign In</a>
                

                </div>
            </div>
            @endif
             </form>
         </div>
      </div>
   </div>
</section>
@endsection