<?php
if (config('site.logo') && File::exists(public_path('uploads/' . config('site.logo')))) {
	$site_logo = asset('uploads/' . config('site.logo'));
} else {
	$site_logo = config('site.title');
}
if (config('site.mobilelogo') && File::exists(public_path('uploads/' . config('site.mobilelogo')))) {
	$site_mobilelogo = asset('uploads/' . config('site.mobilelogo'));
} else {
	$site_mobilelogo = $site_logo;
}
$site_url = url('/');
$main_menu = get_fields_value_where('pages', "(display_in='1' or display_in='6' or display_in='7' or display_in='9') and parent_id='0'", 'menu_order', 'asc'); // and posttype='page'
$mega_menu = get_fields_value_where('pages', "(display_in='2' or display_in='8' or display_in='7' or display_in='10') and parent_id='0'", 'menu_order', 'asc');
// pre($mega_menu);
// ------------------------------------
$phoneNumber = config('site.whatsapp');

$newPhoneNumber = str_replace(['+', '-'], '', $phoneNumber);
$encodedPhoneNumber = urlencode($newPhoneNumber);
?>
<div class="moblietop">
	<div class="moblie_headertop">
		<div class="container">
			<div class="d-flex align-items-center justify-content-between">
				<figure class="logo_main">
					<a href="{{ $site_url }}"><img src="{{ $site_logo }}" alt="{!! config('site.title') !!}"></a>
				</figure>
				<div class="btn-box flex-shrink-0"> <a href="#" class="btn-primary">Resources</a> </div>
			</div>
			<div class="topmenu">
				<ul class="nav">
					<?php
					foreach ($main_menu as $menu) {
						$slug = $menu->slug;
						$slug = ($menu->id == 1) ? '' : $slug;
						$active_menu = '';
						if (@$page) {
							$active_menu = ($page && ($page->parent_id == $menu->id || $page->id == $menu->id)) ? 'current-active' : '';
						}
						$main_sub_menu = get_fields_value_where('pages', "(display_in='1' or display_in='6' or display_in='7' or display_in='9') and parent_id='" . $menu->id . "'", 'menu_order', 'asc');
					?>
						<li class="nav-item {!!$active_menu!!}">
							<a class="nav-link" href="{{url('/'.$slug)}}">{!!$menu->page_name!!}</a>
							@if($main_sub_menu->count() > 0)
							<ul class="submenu main_menu">
								<?php
								foreach ($main_sub_menu as $sub_menu) {
									$sub_slug = $sub_menu->slug;
									$sub_slug = ($menu->id == 1) ? '' : $sub_slug;
									$active_sub_menu = '';
									if (@$page) {
										$active_sub_menu = ($page && ($page->parent_id == $sub_menu->id || $page->id == $sub_menu->id)) ? 'current-active' : '';
									}
								?>
									<li class="nav-item {!!$active_sub_menu!!}"><a href="{{url('/'.$sub_slug)}}">{{$sub_menu->page_name}}</a></li>
								<?php
								}
								?>
							</ul>
							@endif
						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="moblie_header_bottom">
		<div class="container">
			<div class="row">
				<div class="d-flex justify-content-between">
					<figure class="logo"> <a href="{{ $site_url }}"><img src="{{ $site_mobilelogo }}" alt="{!! config('site.title') !!}"></a> </figure>
					<div class="header-right d-flex align-items-center justify-content-end freeweb">
						<div class="header_phonebox d-flex align-items-center">
							<div class="phoneicon"><a class="phoneiconnew" href="{!!preg_replace('/\D+/', '', config('site.phone'))!!}" aria-label="Call us at {!!preg_replace('/\D+/', '', config('site.phone'))!!}"><i class="fa-solid fa-phone"></i></a><span>call us</span></div>
							<div class="user"> <a href="#" aria-label="User Profile"><i class="fa-solid fa-user"></i></a></div>
							<div class="user"> <a href="#" aria-label="Cart"><i class="fa-solid fa-cart-shopping"></i></a></div>
						</div>
						<div class="menu">
							<div class="menuButton"> <span></span> <span></span> <span></span> </div>
							<ul>
								<?php
								foreach ($mega_menu as $menu) {
									$slug = $menu->slug;
									$slug = ($menu->id == 1) ? '' : $slug;
									$active_menu = '';
									if (@$page) {
										$active_menu = ($page && ($page->parent_id == $menu->id || $page->id == $menu->id)) ? 'current-active' : '';
									}
									$mega_sub_menu = get_fields_value_where('pages', "(display_in='2' or display_in='8' or display_in='7') and parent_id='" . $menu->id . "'", 'menu_order', 'asc');
								?>
									<li class="{!!$active_menu!!} {{$menu->id=='162' || $menu->id=='394' ? 'onerow' : ''}}">
										<div class="menuLink" @if($menu->id != 33 && $menu->id != 89 && $menu->id != 92 && $menu->id != 162 && $menu->id != 394) href=" {{url('/'.$slug)}} " @endif>{!!$menu->page_name!!}


											@if($mega_sub_menu->count() > 0)
											<span><i class="fas fa-chevron-down"></i></span>
											@endif
										</div>
										@if($mega_sub_menu->count() > 0)
										<ul class="submenu mega_menu">
											@if($menu->id!='162')
											@if($menu->id!='394' && $menu->id!='89' && $menu->id!='92')
											<li class="{!!$active_menu!!}">
												@if($menu->redirect_to)
												<a href="{{url($menu->redirect_to)}}">{{$menu->page_name}}</a>
												@else
												<a href="{{url('/'.$slug)}}">{{$menu->page_name}}</a>
												@endif
											</li>@endif
											@endif
											<?php
											foreach ($mega_sub_menu as $sub_menu) {
												$sub_slug = $sub_menu->slug;
												$sub_slug = ($menu->id == 1) ? '' : $sub_slug;
												$active_sub_menu = '';
												if (@$page) {
													$active_sub_menu = ($page && ($page->parent_id == $sub_menu->id || $page->id == $sub_menu->id)) ? 'current-active' : '';
												}
											?>
												@if($menu->id =='162')
												<?php
												$active_menu = '';
												$resources = getImportantHeaderRescources()->groupBy(function ($item) {
													return substr($item->key, -1); // Group items by the last character of the key
												});

												foreach ($resources as $group) {
													$titleKey = $group->first(function ($item) {
														return strpos($item->key, 'header_resource_title') !== false;
													});

													$linkKey = $group->first(function ($item) {
														return strpos($item->key, 'header_resource_link') !== false;
													});

													$title = ($titleKey) ? $titleKey->value : '';
													$link = ($linkKey) ? $linkKey->value : '';

													if ($link && $title) { ?>
														<li class="{!!$active_menu!!}"><a href="{{ $link }}">{{$title}}</a></li>
												<?php	}
												}
												?>
												@endif
												<li class="{!!$active_sub_menu!!}">
													@if($sub_menu->redirect_to)
													<a href="{{url($sub_menu->redirect_to)}}">{{$sub_menu->page_name}}</a>
													@else
													<a href="{{url('/'.$sub_slug)}}">{{$sub_menu->page_name}}</a>
													@endif
												</li>
											<?php
											}
											?>
										</ul>
										@endif
									</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<header class="headermain-area">
	<div class="header-top-area">
		<div class="container">
			<div class="top-body">
				<div class="shape"></div>
				<div class="d-flex justify-content-between align-items-center">
					<ul class="headernumber-list" style="width: 600px;">
						@if(config('site.phone'))
						<li>
							<div class="d-flex headernumber">
								<figure class="flex-shrink-0 headernumber-icon d-flex align-items-center justify-content-center"> <img src="{{ asset('frontend/images/Flag.webp')}}" alt="flag" width="20" height="14"> </figure>
								<div class="flex-grow-1 headernumber-body"> <a href="tel:{!!preg_replace('/\D+/', '', config('site.phone'))!!}">{!!config('site.phone')!!}</a> </div>
							</div>
						</li>
						@endif
						@if(config('site.whatsapp'))
						<li>
							<div class="d-flex headernumber">
								<figure class="flex-shrink-0 headernumber-icon d-flex align-items-center justify-content-center">
									<img src="{{ asset('frontend/images/Whatsapp.webp')}}" alt="Whatsapp" width="20" height="20">
								</figure>
								<div class="flex-grow-1 headernumber-body">
									<a href="https://api.whatsapp.com/send/?phone={{ $encodedPhoneNumber }}&text=Hi&type=phone_number&app_absent=0" target="_blank">{!!config('site.whatsapp')!!}</a>
								</div>
							</div>
						</li>
						@endif
						@if(config('site.skype_link'))
						<li>
							<div class="d-flex headernumber">
								<figure class="flex-shrink-0 headernumber-icon d-flex align-items-center justify-content-center"> <img src="{{ asset('frontend/images/Skype.webp')}}" alt="Skype" width="20" height="20"> </figure>
								<div class="flex-grow-1 headernumber-body">
									<a href="{!!config('site.skype_link')!!}" target="_blank">bebrandigital</a>
								</div>
							</div>
						</li>
						@endif
					</ul>
					<div class="d-flex">
						<?php
						$user = session('client_data');
						$userArray = json_decode(json_encode($user), true);
						// echo "<pre>";
						// print_r($userArray);
						$user = auth()->user();
						?>
						@if(!$user)
						<div class="signin-box d-flex align-items-center"><img src="{{ asset('frontend/images/userplus.webp')}}" alt="userplus" width="15"> <a href="#" data-bs-toggle="modal" data-bs-target="#authModal" class="btn-link">Login</a>
							@else
							<div class="t-h-dropdown">
								<div class="main-link">
									<i class="icon-user pr-2"></i> <span class="text-label"></span>
								</div>
								<div class="t-h-dropdown-menu d-flex">
									<a href="{{  route('user_logout')}} " class="nav-link  text-white px-3"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
									<a href="{{  route('user_dashbrad')}} " class="nav-link  text-white px-3"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
								</div>
							</div>
							@endif

							<!--/<a href="#" class="btn-link">Sign up</a> -->
						</div>
						<div class="cart-box position-relative">
							<?php
							$cart_data = []; // Initialize $cart_data as an empty array
							if (!is_null($userArray) && isset($userArray['id'])) {
								$cart_data = DB::table('cart_items')->where('client_id', $userArray['id'])->get()->toArray();
							}

							$price = [];
							if (!empty($cart_data)) {
								foreach ($cart_data as $key => $val) {
									$price[] = $val->price;
								}
							}
							?>
							<button class="btn-cart">
								<img src="{{ asset('frontend/images/cart.webp')}}" alt="cart" width="18">
								<span class="cart-number d-flex align-items-center justify-content-center">
									@php echo (is_array($cart_data) && count($cart_data) > 0) ? count($cart_data) : 0; @endphp
								</span>
							</button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-area d-flex align-items-center">
		<div class="container">
			<div class="d-flex justify-content-between">
				<figure class="logo">
					<a href="{{ $site_url }}"><img src="{{ $site_logo }}" alt="{!! config('site.title') !!}"></a>
				</figure>
				<div class="header-right d-flex align-items-center justify-content-end">
					<ul class="nav">
						<?php
						$active_menu = '';

						// Place the code within this section
						$resources = getNavbar()->groupBy(function ($item) {
							return substr($item->key, -1); // Group items by the last character of the key
						});

						foreach ($resources as $group) {
							$titleKey = $group->first(function ($item) {
								return strpos($item->key, 'header_nav_title') !== false;
							});

							$linkKey = $group->first(function ($item) {
								return strpos($item->key, 'header_nav_link') !== false;
							});

							$title = ($titleKey) ? $titleKey->value : '';
							$link = ($linkKey) ? $linkKey->value : '';

							if ($link && $title) { ?>
								<li class="{!!$active_menu!!} nav-item "><a class="nav-link" href="{{$link}}">{{$title}}</a></li>
						<?php	}
						}
						// End of the inserted code section
						?>
						<?php
						// foreach ($main_menu as $menu) {
						// 	$slug = $menu->slug;
						// 	$slug = ($menu->id==1) ? '' : $slug ;
						// 	$active_menu = '';
						// 	if (@$page) {
						// 		$active_menu = ($page && ($page->parent_id==$menu->id || $page->id==$menu->id)) ? 'current-active' : '' ;
						// 	}
						// 	$main_sub_menu = get_fields_value_where('pages',"(display_in='1' or display_in='5') and parent_id='".$menu->id."'",'menu_order','asc');
						?>
						{{-- <li class="nav-item {!!$active_menu!!}">
						<a class="nav-link" href="{{url('/'.$slug)}}">{!!$menu->page_name!!}</a>
						@if($main_sub_menu->count() > 0)
						<ul class="main_menu submenu">
							<?php
							foreach ($main_sub_menu as $sub_menu) {
								$sub_slug = $sub_menu->slug;
								$sub_slug = ($menu->id == 1) ? '' : $sub_slug;
								$active_sub_menu = '';
								if (@$page) {
									$active_sub_menu = ($page && ($page->parent_id == $sub_menu->id || $page->id == $sub_menu->id)) ? 'current-active' : '';
								}
							?>
								<li class="nav-item {!!$active_sub_menu!!}"><a href="{{url('/'.$sub_slug)}}">{{$sub_menu->page_name}}</a></li>
							<?php
							}
							?>
						</ul>
						@endif
						</li> --}}
						<?php
						// }
						// 
						?>
					</ul>
					@if(config('site.header_nav_button_link1'))<div class="btn-box"> <a href="{!!config('site.header_nav_button_link1')!!}" class="btn-primary">{!!config('site.header_nav_button_title1')!!}</a> </div>@endif
				</div>
			</div>
		</div>
	</div>
	<div class="menu-area">
		<div class="container">
			<div class=" d-flex align-items-center justify-content-between">
				<figure class="fixlogo"><a href="{{ $site_url }}">

						<img src="{{ $site_logo }}" alt="{!! config('site.title') !!}">
					</a></figure>
				<div class="menu">
					<div class="menuButton"> <span></span> <span></span> <span></span> </div>
					<ul>
						<?php
						foreach ($mega_menu as $menu) {
							$slug = $menu->slug;
							print_r($slug);
							$slug = ($menu->id == 1) ? '' : $slug;
							$active_menu = '';
							if (@$page) {
								$active_menu = ($page && ($page->parent_id == $menu->id || $page->id == $menu->id)) ? 'current-active' : '';
							}
							$mega_sub_menu = get_menu_display('pages', "(display_in='2' or display_in='8' or display_in='7') and parent_id='" . $menu->id . "'", 'menu_order', 'asc');
						?>
							<li class="{!!$active_menu!!} {{$menu->id=='162' || $menu->id=='394' ? 'onerow' : ''}}">
								<a href="{{url('/'.$slug)}}" class="menuLink new" @if($menu->id != 33 && $menu->id != 89 && $menu->id != 92 && $menu->id != 162 && $menu->id != 394) @endif>{!!$menu->page_name!!}
									@if($mega_sub_menu->count() > 0)
									<span><i class="fas fa-chevron-down"></i></span>
									@endif
								</a>
								@if($mega_sub_menu->count() > 0)
								<ul class="megamenu submenu">
									@if($menu->id!='162')

									@if($menu->id!='394' && $menu->id!='89' && $menu->id!='92')<li class="{!!$active_menu!!}">
										@if($menu->redirect_to)
										<a href="{{url($menu->redirect_to)}}">{{$menu->page_name}}</a>
										@else
										<a href="{{url('/'.$slug)}}">{{$menu->page_name}}</a>
										@endif
									</li>@endif
									@endif
									<?php
									foreach ($mega_sub_menu as $sub_menu) {

										$sub_slug = $sub_menu->slug;
										$sub_slug = ($menu->id == 1) ? '' : $sub_slug;
										$active_sub_menu = '';
										if (@$page) {
											$active_sub_menu = ($page && ($page->parent_id == $sub_menu->id || $page->id == $sub_menu->id)) ? 'current-active' : '';
										}
									?>
										@if($menu->id =='162')
										<?php
										$active_menu = '';
										$resources = getImportantHeaderRescources()->groupBy(function ($item) {
											return substr($item->key, -1);
										});
										foreach ($resources as $group) {
											$titleKey = $group->first(function ($item) {
												return strpos($item->key, 'header_resource_title') !== false;
											});

											$linkKey = $group->first(function ($item) {
												return strpos($item->key, 'header_resource_link') !== false;
											});

											$title = ($titleKey) ? $titleKey->value : '';
											$link = ($linkKey) ? $linkKey->value : '';

											if ($link && $title) { ?>
												<li class="{!!$active_menu!!}"><a href="{{$link}}">{{$title}}</a></li>
										<?php	}
										}
										?>
										@endif
										@if($sub_menu->id != 160)<li class="{!!$active_sub_menu!!}">
											@if($sub_menu->redirect_to)
											<a href="{{url($sub_menu->redirect_to)}}">{{$sub_menu->page_name}}</a>
											@else
											<a href="{{url('/'.$sub_slug)}}">{{$sub_menu->page_name}}</a>
											@endif
										</li>@endif
									<?php
									}
									?>
									@if($menu->id!='162')

									@endif
								</ul>
								@endif
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="card caart_box rounded p-3 shadow" style="width: 12rem; background: #f5f5f5;display:none;">
		<div class="card-body">
			<div class="card-title text-white text-center p-2 rounded" style="margin-bottom: 20px;background-color: #181e4e;">Your Cart</div>
			<!--<h6 class="card-subtitle mb-2 text-black">Sub Total : <?php array_sum($price); ?></h6></h6>-->
			<div class="w-100 btn-primary rounded">
				<a href="{{ route('cart.show') }}" class="card-link text-white">View Cart</a>
			</div>
		</div>
	</div>
</header>
<style>
	.m-w-600 {
		max-width: 450px;
		margin: auto;
	}

	.s-b {
		display: block;
		cursor: pointer;
		margin-left: 5px;
	}

	.modal.fade.show {
		z-index: 99999
	}

	.btn-close {
		display: block;
		width: 50px;
		height: 44px;
		margin-left: auto;
	}

	.b-r {
		border-radius: 20px;
		display: block;
		width: 100%;
	}
</style>

<!-- Login / Signup Modal -->
<div id="authModal" class="modal fade" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="text-end">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<!-- Login Form -->
				<div id="loginForm" class="auth-forms">

					<div class="">
						<div class="row g-0">
							<div class="col-12 d-flex align-items-center justify-content-center">
								<div class="col-12 col-xl-10">
									<div class="card-body">
										<div class="mb-3 text-center">
											<a href="#!">
												<img src="https://bebran.com/public/uploads/1728145074_1728068400_1684411706_1683115263_be-bran-header-logo.webp" alt="Logo" width="175" height="57">
											</a>
										</div>
										<div class="d-flex gap-3 flex-column">
											<a href="{{ route('auth.google') }}" class="btn btn-lg btn-outline-dark">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
													<path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
												</svg>
												<span class="ms-2 fs-6">Log in with Google</span>
											</a>
										</div>
										<div class="d-flex gap-3 flex-column mt-3">
											<a href="{{ route('facebook.auth.facebook') }}" class="btn btn-lg btn-outline-primary">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                  <path d="M8.667 16V8.667h2.166l.325-2.5H8.667V4.667c0-.725.2-1.217 1.234-1.217h1.299V1.275C10.884 1.215 10.072 1 9.195 1 7.386 1 6.333 2.105 6.333 3.976V6.167H4.5v2.5h1.833V16h2.334z"/>
                                                </svg>

												<span class="ms-2 fs-6">Log in with Facebook</span>
											</a>
										</div>
										<div class="d-flex gap-3 flex-column mt-3">
											<a href="" class="btn btn-lg btn-outline-primary">
												<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-apple" viewBox="0 0 16 16">
                                                  <path d="M10.71 1.7c-.55.6-1.34.92-2.08.89-.1-.69.21-1.45.65-1.9.55-.58 1.44-.98 2.08-.98.1.7-.26 1.44-.65 1.99zM12.36 4.32c-1.14-.07-2.07.65-2.6.65-.57 0-1.44-.64-2.37-.62-1.22.02-2.34.71-2.97 1.8-1.3 2.2-.33 5.47.91 7.27.59.85 1.27 1.8 2.17 1.77.87-.04 1.2-.57 2.3-.57 1.1 0 1.39.57 2.3.56.92-.02 1.5-.87 2.1-1.73.64-.94.9-1.86.92-1.91-.02-.02-1.79-.68-1.81-2.65-.02-1.66 1.41-2.43 1.48-2.47-.82-1.21-2.06-1.35-2.49-1.38z"/>
                                                </svg>
												<span class="ms-2 fs-6">Log in with Apple Id</span>
											</a>
										</div>

										<p class="text-center mt-3 mb-3">Or sign in with</p>

										<form method="POST" action="{{ route('client.login') }}">
											@csrf
											<div class="row gy-3">
												<div class="col-12">
													<div class="form-floating mb-3">
														<input type="email" class="form-control" name="login_email" id="login_email" placeholder="name@example.com" required>
														<label for="login_email">Email</label>
													</div>
												</div>
												<div class="col-12">
													<div class="form-floating mb-3">
														<input type="password" class="form-control" name="login_password" id="login_password" placeholder="Password" required>
														<label for="login_password">Password</label>
													</div>
												</div>
												<div class="col-12">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
														<label class="form-check-label" for="remember_me">Keep me logged in</label>
													</div>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-primary btn-lg b-r">Log in now</button>
													</div>
												</div>
											</div>
										</form>

										<div class="d-flex justify-content-center mt-3">
											Don’t have an account? <a id="showSignupForm" class="link-primary s-b">Sign Up</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>



				<!-- Signup Form -->
				<div id="signupForm" class="auth-forms" style="display: none;">

					<div class="">
						<div class="row g-0">
							<div class="col-12 d-flex align-items-center justify-content-center">
								<div class="card-body">
									<div class="mb-4 text-center">
										<a href="#!">
											<img src="https://bebran.com/public/uploads/1728145074_1728068400_1684411706_1683115263_be-bran-header-logo.webp" alt="Logo" width="175" height="57">
										</a>
									</div>
									<div class="d-flex gap-3 flex-column">
										<a href="{{ route('auth.google') }}" class="btn btn-lg btn-outline-dark">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
												<path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
											</svg>
											<span class="ms-2 fs-6">Log in with Google</span>
										</a>
									</div>
									<div class="d-flex gap-3 flex-column mt-3">
										<a href="{{ route('facebook.auth.facebook') }}" class="btn btn-lg btn-outline-primary">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                              <path d="M8.667 16V8.667h2.166l.325-2.5H8.667V4.667c0-.725.2-1.217 1.234-1.217h1.299V1.275C10.884 1.215 10.072 1 9.195 1 7.386 1 6.333 2.105 6.333 3.976V6.167H4.5v2.5h1.833V16h2.334z"/>
                                            </svg>

											<span class="ms-2 fs-6">Log in with Facebook</span>
										</a>
									</div>

									<p class="text-center mt-3 mb-3">Or Register in with</p>
									<form method="POST" action="{{ route('user.register') }}">
										@csrf
										<div class="row gy-3">
											<div class="col-6">
												<div class="form-group">
													<label for="reg-fn">First Name</label>
													<input type="text" class="form-control" name="first_name" placeholder="First Name" id="reg-fn" required>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="reg-ln">Last Name</label>
													<input type="text" class="form-control" name="last_name" placeholder="Last Name" id="reg-ln" required>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="reg-email">Email</label>
													<input type="email" class="form-control" name="email" placeholder="Email" id="reg-email" required>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="reg-phone">Phone Number</label>
													<input type="text" class="form-control" name="phone" placeholder="Phone Number" id="reg-phone">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="reg-pass">Password</label>
													<input type="password" class="form-control" name="password" placeholder="Password" id="reg-pass" required>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="reg-pass-confirm">Confirm Password</label>
													<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" id="reg-pass-confirm" required>
												</div>
											</div>
											<div class="col-12 text-center mt-3">
												<input type="submit" class="btn btn-primary btn-lg b-r" value="Register">
											</div>
										</div>
									</form>

									<div class="d-flex justify-content-center mt-3">
										Already have an account? <a id="showLoginForm" href="#" class="link-primary s-b">Sign in</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
</div>