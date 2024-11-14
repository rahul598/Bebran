<?php 
if (config('site.logo') && File::exists(public_path('uploads/'.config('site.logo')))) {
  $site_logo = asset('/uploads/'.config('site.logo'));
}else{
  $site_logo = config('site.title');
}
if (config('site.footer_logo') && File::exists(public_path('uploads/'.config('site.footer_logo')))) {
  $site_footer_logo = asset('/uploads/'.config('site.footer_logo'));
}else{
  $site_footer_logo = $site_logo;
}

 if (config('site.payment_methods') && File::exists(public_path('uploads/'.config('site.payment_methods')))) {
   $site_payment_methods = asset('/uploads/'.config('site.payment_methods'));
 }else{
   $site_payment_methods = '';
 }
 if (config('site.buy_with_confidence') && File::exists(public_path('uploads/'.config('site.buy_with_confidence')))) {
   $site_buy_with_confidence = asset('/uploads/'.config('site.buy_with_confidence'));
 }else{
   $site_buy_with_confidence = '';
 }

$site_url = url('/') ;
$footer_menu = get_fields_value_where('pages',"(display_in='5' or display_in='6' or display_in='7')",'menu_order','asc');// and parent_id='0' and posttype='page'
$footer_services_menu = get_fields_value_where('pages',"(display_in='3' or display_in='7' or display_in='10')",'menu_order','asc'); // and parent_id='0'
$footer_resources_menu = get_fields_value_where('pages',"(display_in='4' or display_in='7' or display_in='8' or display_in='9')",'menu_order','asc');

// ------------------------------------
   $phoneNumber = config('site.whatsapp'); 

   $newPhoneNumber = str_replace(['+', '-'], '', $phoneNumber);

   $encodedPhoneNumber = urlencode($newPhoneNumber);
  //  ------------------------------------------
    $currentUrl = url()->current();

    $urlSegments = explode('/', $currentUrl);
    $numSegments = count($urlSegments);

    $getServiceSlug = null;
    if ($numSegments == 4) {
        $getServiceSlug = $urlSegments[3];
    } elseif ($numSegments == 5) {
        $getServiceSlug = $urlSegments[4];
    } elseif ($numSegments == 6) {
      $getServiceSlug = $urlSegments[4];
    }
  //   $currentUrl = url()->current();

  //   $urlSegments = explode('/', $currentUrl);
  //   $numSegments = count($urlSegments);

  //   $getServiceSlug = null;

  //   if ($numSegments == 5) {
  //       $getServiceSlug = $urlSegments[4];
  //   } elseif ($numSegments == 6) {
  //       $getServiceSlug = $urlSegments[5];
  // }

  $checkCity = Request::segment(1);
  $checkingData = Request::segment(2);
  $checkingBusiness = Request::segment(3);
  $checkCityDataVal = checkCityData($checkCity);
  
  if (!empty($checkingData)) {

    $checkSlugDataVal = checkSlugData($checkingData);
  } else {
      $checkSlugDataVal = checkSlugData($checkCity);
  }
  if (!empty($checkingData)) {
    $checkBusinessDataVal = checkBusinessData($checkingData);
  } else {
      $checkBusinessDataVal = checkBusinessData($checkCity);
  }

  if (!empty($checkingData)  && !empty($checkCity)) {
    $checkAllDataVal = checkAllData($checkingData,$checkCity);
  }else{
    $checkAllDataVal= '';
  }

  if (!empty($checkingData)  && !empty($checkCity) && !empty($checkingBusiness)) {
    $checkCityBusinessVal = checkCityBusiness($checkingData,$checkCity,$checkingBusiness);
  }else{
    $checkCityBusinessVal= '';
  }
?>
@if(Request::segment(1) != '404')
<div class="countries-we-serve-area">
  <div class="container">
     <div class="card">
        <nav>
           <div class="nav nav-tabs"  role="tablist">
              <button class="nav-link active"  data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-selected="true">COUNTRY WE SERVE</button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-selected="false" tabindex="-1">CITY WE SERVE</button>
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-business" type="button" role="tab" aria-selected="false" tabindex="-1">BUSINESS WE SERVE</button>
           </div>
        </nav>
        <div class="tab-content p-3"  >
           <div class="tab-pane fade active show" id="nav-home" role="tabpanel">
              <div class="row g-4 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xxl-5 justify-content-center align-items-center">
                 @php
                 $countries = getCountries()->groupBy(function ($item) {
                     return substr($item->key, -1); 
                     });
                    //  echo "<divre>";
                      // print_r($countries);exit;
                 @endphp
                 
                 @foreach ($countries as $group)
                     @php
                         $titleKey = $group->first(function ($item) {
                             return strpos($item->key, 'country_title') !== false;
                         });
                 
                         $linkKey = $group->first(function ($item) {
                             return strpos($item->key, 'country_link') !== false;
                         });
                 
                         $title = ($titleKey) ? $titleKey->value : '';
                         $link = ($linkKey) ? $linkKey->value : '';
                     @endphp
                 
                     @if ($link || $title)
                        <div class="col">
                          <button class="cityname" onclick="location.href='{{ $link }}'" type="button">{{ $title }}</button>
                      </div>
                     @endif
                 @endforeach

              </div>
           </div>
           <div class="tab-pane fade" id="nav-profile" role="tabpanel">
              <div class="row tab2name g-2 row-cols-3 row-cols-sm-5 row-cols-md-6 row-cols-lg-6 row-cols-xxl-6 justify-content-center align-items-center">
                @if($checkCity  == null)
                  @foreach (getCitiesData() as $key=>$val)
                    <div class="col">
                      <button class="cityname" onclick="location.href='{{ url(strtolower($val->slug).'/'.getServiceData()) }}'" type="button">{{ $val->city_name }}</button>
                    </div>
                  @endforeach
                @elseif($checkCityBusinessVal == 1) 
                  @foreach (getCitiesData() as $key=>$val)
                  <div class="col">
                         <button class="cityname" onclick="location.href='{{ url(strtolower($val->slug).'/'.$getServiceSlug.'/'.$checkingBusiness) }}'" type="button">{{ $val->city_name }}</button>
                  </div>
                  @endforeach
                @elseif($checkSlugDataVal == 1)
                 @foreach (getCitiesData() as $key=>$val)
                  <div class="col">
                    <button class="cityname" onclick="location.href='{{ url(strtolower($val->slug).'/'.getServiceData()) }}'" type="button">{{ $val->city_name }}</button>
                  </div>
                  @endforeach
                @elseif($checkBusinessDataVal == 4)
                 @foreach (getCitiesData() as $key=>$val)
                  <div class="col">
                    <button class="cityname" onclick="location.href='{{ url(strtolower($val->slug).'/'.$checkCity.'/'.$checkingData) }}'" type="button">{{ $val->city_name }}</button>
                  </div>
                  @endforeach
                 @else 
                 @foreach (getCitiesData() as $key=>$val)
                 <div class="col">
                   <button class="cityname" onclick="location.href='{{ url(strtolower($val->slug).'/'.$getServiceSlug) }}'" type="button">{{ $val->city_name }}</button>
                 </div>
                 @endforeach
                @endif
              </div>
           </div>

           <div class="tab-pane fade" id="nav-business" role="tabpanel">
              <div class="row tab2name g-2 row-cols-2 row-cols-sm-5 row-cols-md-4 row-cols-lg-5 row-cols-xxl-5 justify-content-center align-items-center">
                 @if($checkCity  == null)

                  @foreach (getBusinessData() as $key=>$val)
                    <div class="col">
                      <button class="cityname" onclick="location.href='{{ url(getServiceData().'/'.strtolower($val->slug)) }}'" type="button">{{ $val->business_name }}</button>
                    </div>
                  @endforeach
                @elseif($checkSlugDataVal == 1)

                 @foreach (getBusinessData() as $key=>$val)
                  <div class="col">
                    <button class="cityname" onclick="location.href='{{ url(getServiceData().'/'.strtolower($val->slug)) }}'" type="button">{{ $val->business_name }}</button>
                  </div>
                  @endforeach
                @elseif($checkSlugDataVal == 2)

                 @foreach (getBusinessData() as $key=>$val)
                  <div class="col">
                    <button class="cityname" onclick="location.href='{{ url($checkCity.'/'.strtolower($val->slug)) }}'" type="button">{{ $val->business_name }}</button>  
                  </div>
                  @endforeach
                 @elseif($checkAllDataVal == 1) 

                 @foreach (getBusinessData() as $key=>$val)
                 <div class="col">
                   <button class="cityname" onclick="location.href='{{ url($checkCity.'/'.$getServiceSlug.'/'.strtolower($val->slug)) }}'" type="button">{{ $val->business_name }}</button>  
                 </div>
                 @endforeach
                 @elseif($checkCityBusinessVal == 1) 

                 @foreach (getBusinessData() as $key=>$val)
                 <div class="col">
                   <button class="cityname" onclick="location.href='{{ url($checkCity.'/'.$getServiceSlug.'/'.strtolower($val->slug)) }}'" type="button">{{ $val->business_name }}</button> 
                 </div>
                 @endforeach
                @else

                  @foreach (getBusinessData() as $key=>$val)
                  <div class="col">
                    <button class="cityname" onclick="location.href='{{ url($getServiceSlug.'/'.strtolower($val->slug)) }}'" type="button">{{ $val->business_name }}</button> 
                  </div>
                  @endforeach
                @endif
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
@endif
<footer class="footer-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 fww">
            {!!config('site.footer1_title')!!}
          <div class="flogo"><img src="{!! $site_footer_logo !!}" alt="{!! config('site.title') !!}" width="134" height="56"></div>
        </div>
        <div class="col-lg-3 fww1">
            @if(config('site.footer2_title'))
            <div class="footer_h4 text-uppercase">{!!config('site.footer2_title')!!}</div>@endif
            @if(config('site.footer2_title1'))
            <div class="footer_h5"><i class="fa fa-map-marker" aria-hidden="true"></i> {!!config('site.footer2_title1')!!}</div>
            @endif
            @if(config('site.footer2_title6')) 
            <div class="footer_h5"><i class="fa fa-map-marker" aria-hidden="true"></i> {!!config('site.footer2_title6')!!}</div>
            @endif
            @if(config('site.footer2_title2'))
            <div class="footer_h5"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:{!!preg_replace('/\D+/', '', config('site.footer2_title2'))!!}">{!!config('site.footer2_title2')!!}</a></div>
            @endif
            @if(config('site.footer2_title7'))
            <div class="footer_h5"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:{!!preg_replace('/\D+/', '', config('site.footer2_title7'))!!}">{!!config('site.footer2_title7')!!}</a></div>
            @endif
            @if(config('site.footer2_title3'))
            <div class="footer_h5"><i class="fa-solid fa-envelope"></i><a href="mailto:{!!config('site.footer2_title3')!!}">{!!config('site.footer2_title3')!!}</a></div>
            @endif
            @if(config('site.footer2_title4'))
            <div class="footer_h5"><i class="fa-brands fa-whatsapp"></i> 
               <a href="https://api.whatsapp.com/send/?phone={{ $encodedPhoneNumber }}&text=Hi&type=phone_number&app_absent=0" target="_blank">{!!config('site.footer2_title4')!!}</a>
            </div>  
            @endif
            @if(config('site.footer2_title5'))
            <div class="footer_h5"><i class="fa fa-question-circle"></i>
               <a href="{!!config('site.footer2_title5')!!}" target="_blank">{!!config('site.footer2_title5')!!}</a>
            </div>  
            @endif
            @if(config('site.footer2_title8'))
            <div class="footer_h5"><i class="fa-brands fa-skype" aria-hidden="true"></i><a href="{!!config('site.footer2_title8')!!}" target="_blank">Skype</a></div>
            @endif
        </div>
        <div class="col-lg-3 fww2">
          @if(config('site.footer3_title'))<div class="footer_h4">{!!config('site.footer3_title')!!}</div>@endif
          <ul>
            <?php $active_menu = ''; ?>
            @foreach (getImportantOurServices() as $key => $menu)
                @if ($menu->slug)
                    <li class="{!! $active_menu !!}">
                        <a href="{{ url('/' . $menu->slug) }}">{!! $menu->page_name !!}</a>
                    </li>
                @endif
            @endforeach
          </ul>
        </div>
        <div class="col-lg-3 fww3">
          @if(config('site.footer4_title'))<div class="footer_h4 text-uppercase">{!!config('site.footer4_title')!!}</div>@endif
          <ul>
            <?php $active_menu = ''; 
            // echo "<divre>";
            //   print_r(getImportantRescources());exit;
            ?>
            @php
            $resources = getImportantRescources()->groupBy(function ($item) {
                return substr($item->key, -1); // Group items by the last character of the key
                });
            @endphp
            
            @foreach ($resources as $group)
                @php
                    $titleKey = $group->first(function ($item) {
                        return strpos($item->key, 'resource_title') !== false;
                    });
            
                    $linkKey = $group->first(function ($item) {
                        return strpos($item->key, 'resource_link') !== false;
                    });
            
                    $title = ($titleKey) ? $titleKey->value : '';
                    $link = ($linkKey) ? $linkKey->value : '';
                @endphp
            
                @if ($link || $title)
                    <li class="{!! $active_menu !!}">
                        <a href="{{ $link }}">{{ $title }}</a>
                    </li>
                @endif
            @endforeach
          </ul>
        </div>
        <div class="col-lg-3 fww4">
          @if(config('site.footer5_title'))<div class="footer_h4 text-uppercase">{!!config('site.footer5_title')!!}</div>@endif
          <ul>
            @if(config('site.facebook_link'))
            <li><i class="fa-brands fa-facebook-f"></i><a href="{!!config('site.facebook_link')!!}" target="_blank">Facebook </a></li>
            @endif
            @if(config('site.twitter_link'))
            <li>
               <img src="{{ asset('frontend/images/twitter-x-svg.webp') }}" alt="Follow us on Twitter" style="width: 10%; margin-right: 13px;">
                     
    <a href="{!!config('site.twitter_link')!!}" target="_blank">Twitter </a></li>
            @endif
            @if(config('site.linkedin_link'))
            <li><i class="fa-brands fa-linkedin-in"></i><a href="{!!config('site.linkedin_link')!!}" target="_blank">LinkedIn </a></li>
            @endif
            @if(config('site.instagram_link'))
            <li><i class="fa-brands fa-instagram"></i><a href="{!!config('site.instagram_link')!!}" target="_blank">Instagram </a></li>
            @endif
            @if(config('site.community_link'))
            <li><i class="fa fa-users" aria-hidden="true"></i><a href="{!!config('site.community_link')!!}" target="_blank">Our Community </a></li>
            @endif
            @if(config('site.pinterest_link'))
            <li><i class="fa-brands fa-pinterest"></i><a href="{!!config('site.pinterest_link')!!}" target="_blank">Pinterest </a></li>
            @endif
            @if(config('site.youtube_link'))
            <li><i class="fa-brands fa-youtube"></i><a href="{!!config('site.youtube_link')!!}" target="_blank">Youtube </a></li>
            @endif
          </ul>
        </div>
      </div>
      {{-- <ol>
        <?php
        foreach ($footer_menu as $menu) //{
            $slug = $menu->slug;
            $slug = ($menu->id==1) ? '' : $slug ;$active_menu = '';
        ?>
        <li class="{!!$active_menu!!}"><a href="{{url('/'.$slug)}}">{!!$menu->page_name!!}</a></li>
        <?php //} ?>
        <!-- <li><a href="#">Sitemap</a></li> -->
      </ol> --}}
      <ol>
        <?php $active_menu = ''; ?>
          @foreach (getImportantLinks() as $key => $menu)
              @if ($menu->slug)
                  <li class="{!! $active_menu !!}">
                      <a href="{{ url('/' . $menu->slug) }}">{!! $menu->page_name !!}</a>
                  </li>
              @endif
          @endforeach
      </ol>
    </div>
  </footer>
  <div class="payment">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="text-white payment_h5"><span>Payment methods:</span> 
            @if($site_payment_methods)
            <img src="{!! $site_payment_methods !!}" alt="{{ getImageNameAlt($site_payment_methods) }}" width="270" height="28">
            @endif
          
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          @if($site_buy_with_confidence)
          <div class="text-white payment_h5"><span>Buy With Confidence:</span> 
            <img src="{!! $site_buy_with_confidence !!}" alt="{{ getImageNameAlt($site_buy_with_confidence) }}" width="246" height="31">
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copyright">
    <div class="container">
      <div class="copyright_h5">
        @if(config('site.copyright'))
          @php $currentYear = date("Y"); @endphp
          Copyright © @php echo str_replace('{#Year#}', $currentYear, '{#Year#}'); @endphp
          BeBran Digital. All Rights Reserved.
        @endif
      </div>
    
    </div>
  </div>
  <div class="stykebox">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        @if(config('site.phone'))
        <div class="colbox"><a href="tel:{!!preg_replace('/\D+/', '', config('site.phone'))!!}"><span><i class="fa-solid fa-phone"></i></span>Call Us : {!!config('site.phone')!!}</a></div>
        @endif
        @if(config('site.skype_link'))
        <div class="colbox"><a href="{!!config('site.skype_link')!!}" target="_blank"><span><i class="fa-brands fa-skype"></i></span>Skype Us : bebrandigital </a></div>
        @endif
        @if(config('site.book_appointment'))
        <div class="colbox"><a href="{!!config('site.book_appointment')!!}"><span><i class="fa-solid fa-calendar-days"></i></span>Book Appointment</a></div>
        @endif
        @if(config('site.whatsapp'))
        <div class="colbox"> 
         <a href="https://api.whatsapp.com/send/?phone={{ $encodedPhoneNumber }}&text=Hi&type=phone_number&app_absent=0" target="_blank"><span><i class="fa-brands fa-whatsapp"></i></span>WhatsApp Only : {!!config('site.whatsapp')!!}</a>
        </div>
        @endif
      </div>
    </div>
  </div>
  <a id="button"><span><i class="fa fa-angle-up" aria-hidden="true"></i></span></a> 

