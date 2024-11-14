@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('frontend/css/stylej.css') }}">
@section('more-css') 
@endsection 
@section('content') 
	<div class="container custom-container">
		<div class="row main-row">
			<div class="col-md-8 right-side-main">

				<div class="col-lg-12 right-side-upper ">
					<h1><span><i class="fa-solid fa-cart-shopping"></i></span> My Cart</h1>
				</div>
				
      <div class="col-lg-12 lower-three">
				<div class="col-lg-12 right-side-three ">
					<div class="col-lg-4 cart-inner ">
						<p>SEO Plan</p>
						<p class="lower-p">Advance</p>
					</div>
					<div class="col-lg-4 cart-inner div-btn-select ">
						<label for="subscription"></label>
							<select id="subscription" name="subscription" class="select-custom1">
								<option value="advance">Monthly</option>
								<option value="enterprise">Half-Yearly</option>
								<option value="lite">Quaterly</option>
								<option value="standard">Yearly</option>
							</select>
					</div>
					<div class="col-lg-4 cart-inner">
						<p class="p1">RS 23,000</p>
						<p class="p2">45% OFF</p>
						<p class="p3">RS 16,000</p>
						<span><a href="#"><i class="fa-solid fa-x"></i></a></span>
					</div>
				</div>
				<hr class="hr-three">
				<div class="col-lg-12 right-side-three pt-3 ">
					<div class="col-lg-4 cart-inner ">
						<p>Addons</p>
						<p class="lower-p">Social Media Ads Packages</p>
					</div>
					<div class="col-lg-4 cart-inner div-btn-select ">
						<label for="subscription"></label>
							<select id="subscription" name="subscription" class="select-custom1">
								<option value="advance">Monthly</option>
								<option value="enterprise">Half-Yearly</option>
								<option value="lite">Quaterly</option>
								<option value="standard">Yearly</option>
							</select>
					</div>
					<div class="col-lg-4 cart-inner">
						<p class="p3 p5">RS 20,000</p>
						<span class="lower-x"><a href="#"><i class="fa-solid fa-x"></i></a></span>
					</div>
				</div>
			
</div>
			</div>

			<div class="col-md-4 ">
				<aside class="sidebar third-sidebar">
					<div class="widget"></div>
					<div class="lower-section">
						<h2>SEO Plan</h2>
						<div class="add side-add">
							<p>SEO Plan</p> <span>Advance</span> </div>
						<div class="add">
							<p>Billing Cycle</p> <span>Monthly</span> </div>
						<div class="add">
							<p>Addons</p> <span>Social Media Ads Packages</span> </div>
							<hr class="hr-main">
						<div class="add sub-total">
								<p>Subtotal</p> <span>RS 39,400</span> </div>
								<div class="add promo">
									<p>Promo Code</p> <span>
										<input type="text" placeholder="Promo Code.....">
									</span> </div>
									<div class="apply">
										<button>Apply</button>
									</div>
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
						<button class="cancel-btn">Cancel</button>
						<button class="next-btn">Proceed</button>
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