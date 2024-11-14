@extends('layouts.app')
@section('more-css')
<link rel="stylesheet" href="{{ asset('frontend/css/stylej.css') }}">
<style>
   .sticky-aside {
       position: -webkit-sticky; /* For Safari */
       position: sticky;
       top: 20px; /* Adjust this value as needed */
   }
   .jurney .label_head {
       width: 100%;
       background: #181e4e;
       color: #fff;
       padding: 5px;
       border-radius: 5px;
       font-size: 13px;
   }
   .select-custom {
       padding: 3px 4px;
       border-radius: 4px;
       padding-left: 5px;
       margin-left: -6px;
       margin-top: 1px;
       background-color: #e9e9e9;
       border: 1px solid #b8b8b8;
       padding-right: 5px;
   }
   .widget {
       background-image: url(https://project.ambalainfo.com/subscribe/images/subscription-design.png);
   }

   .addons input[type="checkbox"] {
       display: none; /* Hide the checkbox */
   }
   .addons.selected .select-addon{
    background-color: #062c6d;
    border: 1px solid #062c6d;
    color: #fff;
   }
   .addons.selected .price-addon{
    color: #fff;   
   }
    .select-addon{
        align-items: baseline;
        padding-left:10px;
    }
    .select-addon:hover{
        color: #fff;
    }
    
</style>
@endsection

@section('content') 
	<div class="container custom-container">
		<div class="row main-row">
			<div class="col-md-8 right-side-main">
				<div class="col-lg-12 right-side-upper ">
					<h1>Project Details</h1>
				</div>
				<div class="col-lg-12 right-side-lower right-side-2 ">
					<div class="first-div">
                        <label>Website URL:</label>
                        <input type="text" value="" placeholder="Website URL.....">
                    </div>
                    <div class="first-div">
                        <label>Target Location:</label>
                        <input type="text" value="" placeholder="Target Location.....">
                    </div>
                    <div class="first-div">
                        <label>Description:</label>
                        <textarea name="message" rows="4" cols="50" placeholder="Description....."></textarea>
                    </div>
				</div>
			
			</div>
			<div class="col-md-4 ">
				<aside class="sidebar">
					<div class="widget"></div>
					<div class="lower-section">
						<h2>SEO Plan</h2>
						<div class="add side-add">
							<p>SEO Plan</p> <span>Advance</span> </div>
						<div class="add">
							<p>Billing Cycle</p> <span>Monthly</span> </div>
						<div class="add">
							<p>Addons</p> <span>Social Media Ads Packages</span> </div>
					</div>
				</aside>
			</div>
		</div>
	</div>
	<div class="container-fluid background-footer mt-4">
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

	<div class="container-fluid background-footer mt-4 only-mob-tab">
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