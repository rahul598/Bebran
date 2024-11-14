<?php 
if (config('site.logo') && File::exists(public_path('uploads/'.config('site.logo')))) {
  $site_logo = asset('uploads/'.config('site.logo'));
}else{
  $site_logo = config('site.title');
}
if (config('site.mobilelogo') && File::exists(public_path('uploads/'.config('site.mobilelogo')))) {
  $site_mobilelogo = asset('uploads/'.config('site.mobilelogo'));
}else{
  $site_mobilelogo = $site_logo;
}
$site_url = url('/') ;
$main_menu = get_fields_value_where('pages',"(display_in='1' or display_in='6' or display_in='7' or display_in='9') and parent_id='0'",'menu_order','asc');// and posttype='page'
$mega_menu = get_fields_value_where('pages',"(display_in='2' or display_in='8' or display_in='7' or display_in='10') and parent_id='0'",'menu_order','asc');

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
					<a href="{{ $site_url }}"><img src="{{ $site_logo }}" alt="{!! config('site.title') !!}"></a></figure>
				<div class="btn-box flex-shrink-0"> <a href="#" class="btn-primary">Resources</a> </div>
			</div>
			<div class="topmenu">
				<ul class="nav">
					<?php
					foreach ($main_menu as $menu) {
						$slug = $menu->slug;
						$slug = ($menu->id==1) ? '' : $slug;
						$active_menu = '';
						if (@$page) {
							$active_menu = ($page && ($page->parent_id==$menu->id || $page->id==$menu->id)) ? 'current-active' : '' ;
						}
						$main_sub_menu = get_fields_value_where('pages',"(display_in='1' or display_in='6' or display_in='7' or display_in='9') and parent_id='".$menu->id."'",'menu_order','asc');
					?>
					<li class="nav-item {!!$active_menu!!}">
						<a class="nav-link" href="{{url('/'.$slug)}}">{!!$menu->page_name!!}</a>
						@if($main_sub_menu->count() > 0)
						<ul class="submenu main_menu">
						<?php
						foreach ($main_sub_menu as $sub_menu) {
	                        $sub_slug = $sub_menu->slug;
	                        $sub_slug = ($menu->id==1) ? '' : $sub_slug ;
	                        $active_sub_menu = '';
	                        if (@$page) {
	                          $active_sub_menu = ($page && ($page->parent_id==$sub_menu->id || $page->id==$sub_menu->id)) ? 'current-active' : '' ;
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
							<div class="phoneicon"><a class="phoneiconnew" href="{!!preg_replace('/\D+/', '', config('site.phone'))!!}"><i class="fa-solid fa-phone"></i></a><span>call us</span></div>
							<div class="user"> <a href="#"><i class="fa-solid fa-user"></i></a></div>
							<div class="user"> <a href="#"><i class="fa-solid fa-cart-shopping"></i></a></div>
						</div>
						<div class="menu">
							<div class="menuButton"> <span></span> <span></span> <span></span> </div>
							<ul>
								<?php
								foreach ($mega_menu as $menu) {
									$slug = $menu->slug;
									$slug = ($menu->id==1) ? '' : $slug ;
									$active_menu = '';
									if (@$page) {
										$active_menu = ($page && ($page->parent_id==$menu->id || $page->id==$menu->id)) ? 'current-active' : '' ;
									}
									$mega_sub_menu = get_fields_value_where('pages',"(display_in='2' or display_in='8' or display_in='7') and parent_id='".$menu->id."'",'menu_order','asc');
								?>
								<li class="{!!$active_menu!!} {{$menu->id=='162' || $menu->id=='394' ? 'onerow' : ''}}">
									<a @if($menu->id != 33 && $menu->id != 89 && $menu->id != 92 && $menu->id != 162 && $menu->id != 394) href=" {{url('/'.$slug)}} " @endif>{!!$menu->page_name!!}  


										@if($mega_sub_menu->count() > 0)
										<span><i class="fas fa-chevron-down"></i></span>
										@endif
									</a>
									@if($mega_sub_menu->count() > 0)
									<ul class="submenu mega_menu">
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
				                        $sub_slug = ($menu->id==1) ? '' : $sub_slug ;
				                        $active_sub_menu = '';
				                        if (@$page) {
				                          $active_sub_menu = ($page && ($page->parent_id==$sub_menu->id || $page->id==$sub_menu->id)) ? 'current-active' : '' ;
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
								<div class="flex-grow-1 headernumber-body">  <a href="tel:{!!preg_replace('/\D+/', '', config('site.phone'))!!}">{!!config('site.phone')!!}</a> </div>
							</div>
						</li>
			            @endif
			            @if(config('site.whatsapp'))
						<li>
							<div class="d-flex headernumber">
								<figure class="flex-shrink-0 headernumber-icon d-flex align-items-center justify-content-center"> 
								<img src="{{ asset('frontend/images/Whatsapp.webp')}}" alt="Whatsapp" width="20" height="20"> </figure>
								<div class="flex-grow-1 headernumber-body"> 
									<a href="https://wa.me/{{ $encodedPhoneNumber }}?text=Hi" target="_blank">{!!config('site.whatsapp')!!}</a>
								</div>
							</div>
						</li>
			            @endif
			            @if(config('site.skype_link'))
						<li>
							<div class="d-flex headernumber">
								<figure class="flex-shrink-0 headernumber-icon d-flex align-items-center justify-content-center"> <img src="{{ asset('frontend/images/Skype.webp')}}" alt="Skype"  width="20" height="20"> </figure>
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
                        ?> 
                        @if(empty($userArray))
                            <div class="signin-box d-flex align-items-center"><img src="{{ asset('frontend/images/userplus.webp')}}" alt="userplus" width="15"> <a href="{{ route('user.login')}}" class="btn-link">Login</a>
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
        <img src="{{ asset('frontend/images/cart.webp')}}" alt="cart"  width="18">
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
	                        $sub_slug = ($menu->id==1) ? '' : $sub_slug ;
	                        $active_sub_menu = '';
	                        if (@$page) {
	                          $active_sub_menu = ($page && ($page->parent_id==$sub_menu->id || $page->id==$sub_menu->id)) ? 'current-active' : '' ;
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
					// ?>
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
							$slug = ($menu->id==1) ? '' : $slug ;
							$active_menu = '';
							if (@$page) {
								$active_menu = ($page && ($page->parent_id==$menu->id || $page->id==$menu->id)) ? 'current-active' : '' ;
							}
							$mega_sub_menu = get_menu_display('pages',"(display_in='2' or display_in='8' or display_in='7') and parent_id='".$menu->id."'",'menu_order','asc');
						?>
						<li class="{!!$active_menu!!} {{$menu->id=='162' || $menu->id=='394' ? 'onerow' : ''}}">
							<a @if($menu->id != 33 && $menu->id != 89 && $menu->id != 92 && $menu->id != 162 && $menu->id != 394) href=" {{url('/'.$slug)}} " @endif>{!!$menu->page_name!!}  
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
		                        $sub_slug = ($menu->id==1) ? '' : $sub_slug ;
		                        $active_sub_menu = '';
		                        if (@$page) {
		                          $active_sub_menu = ($page && ($page->parent_id==$sub_menu->id || $page->id==$sub_menu->id)) ? 'current-active' : '' ;
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
                                <h6 class="card-title text-white text-center p-2 rounded" style="margin-bottom: 20px;background-color: #181e4e;">Your Cart</h6>
                                <!--<h6 class="card-subtitle mb-2 text-black">Sub Total : <?php array_sum($price); ?></h6></h6>-->
                                <div class="w-100 btn-primary rounded">
                                    <a href="{{ route('cart.show') }}" class="card-link text-white">View Cart</a>
                                </div>
                              </div>
                            </div>
</header>