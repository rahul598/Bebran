@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/stylej.css') }}">
<style>
 .next-btn {
        background: #062c6d;
        border: 1px solid #062c6d !important;
        width: 125px;
        height: 45px;
        font-family: 'Poppins';
        border: none;
        color: #ffffff;
        border-radius: 30px;
        font-size: 18px;
        transition: 0.5s ease-in-out;
        line-height: 45px;
        text-align: center;
    }
</style>
@section('more-css')  
@endsection
@section('content') 
	<div class="container custom-container">
		<div class="row main-row">
			<div class="col-md-8 right-side-main">
				<div class="col-lg-12 right-side-upper ">
					<h1>Project Details</h1>
				</div>
				<div class="col-lg-12 right-side-lower right-side-2 ">
				    <form action="{{ route('cart.add.new') }}" method="GET">
				        @csrf
				    <input type="hidden" class="form-control" name="service_main" value="{{ $_GET['main_service'] }}">
                    <input type="hidden" class="form-control" name="package_plan" value="{{ $_GET['package_plan'] }}">
                    <input type="hidden" class="form-control" name="plan_duration" value="{{ $_GET['plan_duration'] }}">
                    <input type="hidden" class="form-control" name="addon_service" value="{{ isset($_GET['addon_service']) ? $_GET['addon_service'] : '' }}">
                    <input type="hidden" class="form-control" name="order_price" value="{{ number_format($_GET['order_price'])}}">
					<div class="first-div">
                        <label>Website URL:</label>
                        <input type="text" name="website" value="" placeholder="Website URL.....">
                    </div>
                    <div class="first-div">
                        <label>Target Location:</label>
                        <input type="text" name="targetLocation" value="" placeholder="Target Location.....">
                    </div>
                    <div class="first-div">
                        <label>Description:</label>
                        <textarea name="competitor" rows="4" cols="50" placeholder="Description....."></textarea>
                    </div> 
				</div>
			
			</div>
			<div class="col-md-4 ">
				<aside class="sidebar">
				    <?php $main_service = DB::table('pages')->where('id', $_GET['main_service'])->first(); ?>
					<div class="widget"></div>
					<div class="lower-section">
						<h2>{{ $main_service->page_name}}</h2>
						<div class="add side-add">
							<p>SEO Plan</p> <span>{{ucfirst($_GET['package_plan'])}}</span> </div>
						<div class="add">
							<p>Billing Cycle</p> <span>{{ucfirst($_GET['plan_duration'])}}</span> </div>
						<div class="add">
							<p>Addons</p> <span>Social Media Ads Packages</span> </div>
					</div>
				</aside>
			</div>
		</div>
	</div>
	<div class="container-fluid background-footer mt-4 z1">
		<div class="container">
			<div class="col-lg-12  sticky-footer">
				<div class="row">
					<div class="col-lg-3 footer-inner first-div-inner-footer">
						<p class="head-p"><span><i class="fa-brands fa-searchengin"></i></span> SEO Plan</p>
						<p class="category">Advance</p>
						<p class="price">RS 16,200/mo</p>
					</div>
					<div class="col-lg-3 footer-inner">
						<p class="head-p"><span><i class="fa-solid fa-list-check"></i></span> Project Details</p>
						<p class="category">Provide Details About Your Project</p>
					</div>
					<div class="col-lg-3  footer-inner total-div">
						<p class="total">Total</p>
						<p class="net-price">RS 36,200</p>
					</div>
					<div class="col-lg-3  btn-div">
						<?php
                          $user = session('client_data');
                          $userArray = json_decode(json_encode($user), true); 
                           ?>
                        @if(!empty($userArray))
                        <button type="submit" class="card-link btn btn-primary next-btn w-100">Add To Cart</button>
                        @else 
                                <a class="next-btn" href="{{ route('user.login', [
                                'returnUrl' => url()->current() . '?order_price=' . request()->get('order_price') . '&package_plan=' . request()->get('package_plan') . '&plan_duration=' . request()->get('plan_duration') . '&main_service=' . request()->get('main_service') . '&addon_service=' . request()->get('addon_service')
                            ]) }}" id="nextStepLink" class="card-link btn btn-primary">Sign In</a>
                            
             
                        @endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- seprate footer for mobile tab -->

	<div class="container-fluid background-footer mt-4 only-mob-tab z1">
        <div class="container">
            <div class="col-lg-12 sticky-footer">
                <div class="row">
                    <div class="col-lg-6 footer-inner total-div-2">
                        <div class="col-lg-12 hide-section">
                            <div class="col-lg-12 pt-3">
                                <p class="head-p"><span><i class="fa-brands fa-searchengin"></i></span> SEO Plan</p>
                                <p class="category">Advance</p>
                                <p class="price">RS 16,200/mo</p>
                            </div>
                            <div class="col-lg-12 pt-3">
                                <p class="head-p"><span><i class="fa-solid fa-list-check"></i></span> Project Details</p>
                                <p class="category">Provide Details About Your Project</p>
                            </div>
                            <div class="col-lg-12 pt-3">
                                <p class="total">Total</p>
                                <p class="net-price">RS 36,200</p>
                            </div>
                        </div>
                        <p class="click-show"><i class="fa-solid fa-bars"></i></p>
                    </div>
                    <div class="col-lg-6 btn-div">
                        <button class="cancel-btn">Cancel</button>
                        <button class="next-btn">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
     </form>
@endsection
@section('more-scripts')
<script>
    document.querySelector('.click-show').addEventListener('click', function () {
        var hideSection = document.querySelector('.hide-section');
        hideSection.classList.toggle('show');
        
        // Change the icon
        var icon = this.querySelector('i');
        if (hideSection.classList.contains('show')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-x');
        } else {
            icon.classList.remove('fa-x');
            icon.classList.add('fa-bars');
        }
    });
</script>
@endsection