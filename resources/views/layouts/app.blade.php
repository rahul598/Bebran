<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title><?php
        if (config('site.meta_title')) {
            $meta_title = config('site.meta_title');
        }else{
            $meta_title = config('site.title');
        }

        if(@$setting[0]->value && @$page->id==1){
            echo @$setting[0]->value;
        }elseif (@$setting[0]->value) {
            echo @$setting[0]->value.' | '.$meta_title;
        } else{
            echo $meta_title;
        } ?>
        </title>
    <meta name="description" content="<?php if(@$setting[2]->value){ echo @$setting[2]->value ; }else{ echo config('site.meta_description'); } ?>">
    <meta name="keywords" content="<?php if(@$setting[1]->value){ echo @$setting[1]->value ; }else{ echo config('site.meta_keyword'); } ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))))
    <link rel="apple-touch-icon" href="{!! ( config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) ) ? asset('/uploads/'.config('site.favicon')) : '' !!}" type="image/x-icon">
    @endif
    @if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))))
    <link rel="icon" href="{!! ( config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) ) ? asset('/uploads/'.config('site.favicon')) : '' !!}" type="image/x-icon" sizes="32x32">
    @endif
    @if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))))
    <link rel="icon" href="{!! ( config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) ) ? asset('/uploads/'.config('site.favicon')) : '' !!}" type="image/x-icon" sizes="192x192">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <?php
        if (@$page->posttype != "city-service" && @$page->posttype != "business-service" && @$page->posttype != "city-business-service") {
          if (@$page->meta_tag) {
              $meta_tag = @$page->meta_tag;
          }else{
              $meta_tag = config('site.meta_tag');
          }
        }else{
          if($pageMetaTag){
              $meta_tag = $pageMetaTag;
          }else{
              $meta_tag = config('site.meta_tag');
          }
        } 
        ?>
    {!! $meta_tag !!} 
    
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}"> 

    <link rel="stylesheet" href="{{ asset('frontend/css/fonts.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    
    <link rel="stylesheet" href="{{ asset('frontend/fontawesome/css/all.min.css') }}"> 


    <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/intelli.min.css') }}">
    

    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!--<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">-->
    <style>
    /***footer css***/
    @media (max-width: 479.98px) {
        .payment .payment_h5, .seobox {
            margin-top: 10px;
        }
        .payment .payment_h5 span{
            padding-bottom:5px;
        }
    }
    
    @media (max-width: 767px) {
        .payment .payment_h5 {
            margin-right: 0;
            display: block !important;
            margin-top: 12px;
        }
         .contact_formbox .webtext, .menu ul li span, .payment .payment_h5, .stykebox .colbox {
            text-align: center;
        }
        .payment .payment_h5 span{
            padding-bottom:5px;
        }
    } 
    .payment .payment_h5 span{
        margin-right: 10px;
        text-transform: uppercase; 
    }
    .payment .payment_h5{
        color: #fff !important; 
        display: flex;
        align-items: center;
        font-size: 13px;
    } 
    .copyright .copyright_h5 {
        font-size: 14px;
        color: #fff;
        text-align: center;
        font-family: 'Mulish', sans-serif;
    }
    .footer-area .footer_h5, .footer-area .footer_h5 a {
        margin-bottom: 10px;
        color:#fff;
        display: flex;
        align-items: flex-start;
    }
    .footer-area .footer_h5, .footer-area .footer_h5 a, .footer-area ul li a {
        font-size: 14px;
        color: #fff;
        font-family: Mulish, sans-serif;
    }
    .footer-area .footer_h5 i {
        margin-right: 9px;
        font-size: 16px;
        top: 4px;
        position: relative;
    }
    @media (max-width: 479.98px) {
        .footer-area .footer_h5 {
            display: flex;
            word-break: break-word;
            margin-bottom: 15px;
        }
    }
    
    /***footer css***/
    
    .footer-area h4 {
        font-size: 18px;
        color: #facc15;
        margin-bottom: 20px;
        letter-spacing: 2px;
        font-family: Mulish, sans-serif;
    }
    .talk-numbers-area .talk-numbers-box .second_h4 {
        color: #1a2052;
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 2px;
    }
    .bg_acc_new h2 strong, .bg_acc_new h3 strong, .bg_acc_new .toolssection_h3 strong{
        background: #033355;
        padding: 0 10px;
        border-radius: 10px;
    }
    .toolssection_h3{
        font-size: 34px;
        margin-bottom: 40px;
        font-weight: 700;
        color: #033355;
        font-family: Montserrat;
        text-transform: uppercase;
        position:relative;
    }
    .toolssection_h3 strong {
        color: #ffc145;
        font-weight: 700;
    }
    .headingbox .toolssection_h3::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: -26px;
        width: 90px;
        height: 2px;
        background: #033355;
        right: 0;
        margin: auto;
    }
    .headingbox .toolssection_h3::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -20px;
        width: 157px;
        height: 2px;
        background: #033355;
        right: 0;
        margin: auto;
    } 
    .footer-area .footer_h4, .fww p:nth-child(1){
        font-size: 18px !important;
        color: #facc15;
        margin-bottom: 20px;
        letter-spacing: 2px;
        font-family: Mulish, sans-serif;
        text-transform: uppercase !important;
    }
    .card.about-service-box .card-body .about-service-box_h4 {
        color: #fff;
        font-size: 24px;
        font-weight: 600;
        margin: 0 0 10px;
        text-transform: uppercase;
    }
    .tooluse .tooluse_h5 {
        color: #fff;
        text-transform: capitalize;
        font-size: 30px;
        font-weight: 600;
        margin: 0 0 35px;
        text-align: center;
    }
    .menu ul li div.menuLink {
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        display: block;
        padding: 15px 8px;
        text-transform: uppercase;
    }
    .menu-area.fix .menu ul li div.menuLink {
        color: #013162;
        padding: 24px 5px;
        font-size: 12px;
    }
    .seovideotext .seovideotext_h4 {
        font-size: 21px;
        color: #111;
        font-weight: 500
    }
    .headingbox h2 {
        position: relative;
    }
    .seoclientsay-area .headingbox h2:after, .seoclientsay-area .headingbox h2:before {
        background-color: #fff;
    }
    .businesssection .headingbox h2::before,.headingbox h2:before {
        content: "" !important;
        position: absolute;
        left: 0;
        bottom: -26px;
        width: 90px;
        height: 2px;
        background: #033355;
        right: 0;
        margin: auto
    }
    .businesssection .headingbox h2::after,.headingbox h2:after {
        content: "" !important;
        position: absolute;
        left: 0;
        bottom: -20px;
        width: 157px;
        height: 2px;
        background: #033355;
        right: 0;
        margin: auto
    }
    .headingbox h2 {
    font-size: 34px !important;
    margin-bottom: 40px;
    font-weight: 700;
    color: #033355;
        text-transform: uppercase;
}
    .boltxt .boltxt_h4 {
        padding-left: 60px;
        margin: 18px 0 10px
    }
    .toolssection_h3 strong {
        color: #ffc145;
        font-weight: 700;
    }
    .headingbox .toolssection_h3::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: -26px;
        width: 90px;
        height: 2px;
        background: #033355;
        right: 0;
        margin: auto;
    }
    .headingbox .toolssection_h3::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -20px;
        width: 157px;
        height: 2px;
        background: #033355;
        right: 0;
        margin: auto;
    }
    .headingbox .belowLine::before { 
        background: #fff !important; 
    }
    .headingbox .belowLine::after { 
        background: #fff !important; 
    }
    .card.seoLandingBox .card-body .slider_h4 {
        color: #000;
        font-size: 20px;
        font-weight: 600;
        margin: 0 0 10px;
    }
    .flex-grow-1_h5{
        color: #3c3a3a;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
    }
    .card.seoLandingBox .card-footer .searchPercent .percen_h5 {
        color: #000;
        font-size: 23px;
        font-weight: 600;
        margin: 0;
        text-align: center;
        line-height: 20px;
    }
    .card.seoLandingBox .card-footer .searchPercent .percen_h5 small {
        color: #000;
        font-size: 14px;
        font-weight: 500;
        display: block;
    }
    .strength ul li .strength_h4 {
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        margin: 5px 0;
    }
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .iti__flag {
            background-size: 5632px 15px !important;
        }
    }
    .body_form_label{
        font-size: 13px;
        color: #181e4e;
    }
    .intl-tel-input,
    .iti{
      width: 100%;
    }
    .iti__flag{
      background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/img/flags.png") !important;
    }
    .iti__country-list li{
        background: none !important;
        padding-left: 10px !important;
    }
    .iti__country-list li .iti__country-name{
        color:#000 !important;
    }
    .iti--separate-dial-code .iti__selected-flag{
        background-color: transparent;
    }
    .iti__flag-container:hover .iti__selected-flag{
        background-color: transparent;
    }
    .Suitable th{
        padding:10px !important;
    }
    .sidebar_sticky {
        position: sticky;
        top: 100px;
        position: -webkit-sticky; 
        height: auto;
      } 
      .menu ul li ul li{
          border:none !important;
      }
      .portfoliosection .owl-nav button{
            font-size:30px !important;
        }
.portfoliosection .owl-nav {
            position: absolute;
            top: 45%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .portfoliosection .owl-nav .owl-prev,
        .portfoliosection .owl-nav .owl-next {
            background-color: black;
            color: white;
            padding: 10px;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
        }
        .portfoliosection .owl-nav .owl-prev {
            position: absolute;
            left: -25px;
        }
        .portfoliosection .owl-nav .owl-next {
            position: absolute;
            right: -25px;
        }
        .banner_image_new{
            height: 380px !important; object-fit: cover;
        }
        .ourservice .seoicon_h4,  .seobox_h4 {
            font-size: 24px;
            color: #fff;
            margin: 15px 0;
        }
        .inner-missionvision-area .nav button.active .h4_innerMission{
            padding: 5px 15px 0 55px;
        }
        .inner-missionvision-area .nav button .h4_innerMission {
            /* position: relative; */
            z-index: 1;
            font-size: 18px;
            padding: 0 15px 10px 55px;
            margin-top: 0;
        }                           
        .inner-missionvision-area .nav button .h4_innerMission{
            font-size:18px;
        }
        .review-box .Review_h4 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .dropdown.packages .m-c_h5 span {
            font-family: Mulish;
            font-weight: 800;
            color: #f70;
            font-size: 24px;
            margin: 0 4px;
        }
        .dropdown.packages .m-c_h5 span {
            color: #ff0000 !important;
            font-size: 34px;
        }
        .label_font{
            display:none;
        }
        @media (max-width: 767px) {
            .menu ul li div.menuLink {
                color: #082b6a; 
            }
            .tooluse .tooluse_h5,  .card.about-service-box .card-body .about-service-box_h4 {
                font-size:20px;
            }
            .inner-missionvision-area .nav button .h4_innerMission{
                font-size:16px;
            }
            .ourservice .seoicon_h4, .seobox_h4{
                font-size: 20px;
            }
            .faqarea .container .row .col-lg-6{
                margin-bottom: 20px !important;
            } 
            .banner_image_new{
                height: 125px !important;
            }
        }
        @media (max-width: 639.98px) {
            .strength ul li .strength_h4{
                font-size:20px;
                margin: 8px 0 5px;
            }
            .digitalabout .about-area-two-img img {
                width: 60%;
                object-fit: cover;
                height: 100% !important;
            }
            .featuresection ul.nav, .packages-area .macbook-air-1 ul.nav {
                --bs-nav-link-padding-x: 0.5rem !important; 
            }
        }
        
        @media (max-width:480px){
            .label_font{
                font-size: 12px;
                display:block;
            }
           .ourservice .seoicon_h4, .seobox_h4{
                font-size: 17px;
            }
            .featuresection ul.nav, .packages-area .macbook-air-1 ul.nav {
                --bs-nav-link-padding-x: 0.5rem !important; 
            }
            .talk-numbers-area .talk-numbers-box{
                width:33%;
            }
            .portfoliosection .owl-nav .owl-prev {
                position: absolute;
                left: -11px;
            }
            .portfoliosection .owl-nav .owl-next {
                position: absolute;
                right: -11px;
            }
            .banner_image_new{
                height: 125px !important;
            }
            .service-inner-banner .banner-textbox {
                position: absolute;
                width: 100% !important;
                top: 70% !important;  
                transform: translate(0%, -118%) !important;
            }
        }
        .countries-we-serve-area .tab-pane .cityname{
                border: none;
        }
        .overviewlefttable-last-table{
            height: 750px;
        }
        /*.portfoliosection .owl-nav .owl-prev:hover,*/
        /*.portfoliosection .owl-nav .owl-next:hover {*/
        /*    background-color: gray;*/
        /*}*/
        .oj_contain{
            object-fit:contain;
        }
        .h1_new{
            font-size:70px;
            font-weight:700;
        }
        .copyright h5 {
            font-size: 14px;
            color: #fff;
            text-align: center;
            font-family: 'Mulish', sans-serif;
        }
        .btxt .h_5 {
            font-size: 14px;
            margin-bottom: 5px;
            color: #191919;
            font-weight: 600;
        }
        @media (max-width: 479.98px) {
            .footer-area h5 {
                display: flex;
                word-break: break-word;
                margin-bottom: 15px;
            }
        }
    </style>
    @yield('more-css')
<?php
$page_id = (@$page) ? $page->id : 0 ;
$currentUrl = url()->current();

$urlSegments = explode('/', $currentUrl); 
$structured_data_faq = get_stuctured_data($page_id,$urlSegments); 

$blog_structured_data  = get_blog_stuctured_data($page_id);

?>

@if (!empty($structured_data_faq['extra_data']))
  @php
    $structured_data_faq = $structured_data_faq['extra_data']; // Assuming $structured_data_faq is an array
    $jsonLD = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => []
    ];
    
    foreach ($structured_data_faq as $index => $ex) {
        $question = [
            "@type" => "Question",
            "name" => $ex->title,
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $ex->body
            ]
        ];

        $jsonLD["mainEntity"][] = $question;
    }
@endphp
 @if (!empty($jsonLD['mainEntity']))
 <script type="application/ld+json"> 
        {!! json_encode($jsonLD, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}  
</script>
@endif
@endif

@if(!empty($blog_structured_data))
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $blog_structured_data['page']['page_name'] ?? '' }}",
            "datePublished": "{{ $blog_structured_data['page']['created_at'] ?? '' }}",
            "dateModified": "{{ $blog_structured_data['page']['updated_at'] ?? '' }}",
            "author": [
              {
                "@type": "Person",
                "name": "{{ $blog_structured_data['page']['page_title'] ?? '' }}",
                "url": "{{ $blog_structured_data['page']['author_url'] ?? '' }}"
              },
            ]
          }
    </script>
@endif

<?php
$breadCrumbs = get_breadcrumb_data($page_id);  
?>
@if(count($breadCrumbs["resultArray"]))
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        @foreach($breadCrumbs["resultArray"] as $ex)
          { 
              "@type": "ListItem",
              "position": {!!$ex['position']!!},
              "name": "{!!$ex['name']!!}",
              "item": "{!!$ex['url']!!}"
          }@if (!$loop->last),@endif
      @endforeach
      ]
    }
    </script>
@endif

    {!! config('site.google_analytics') !!}
    
    <?php 
    $tracking_data = DB::table('tracking_code_form')
                    ->where('page_placement', 'lead_form_slider')
                    ->where('status', '1')
                    ->get(); 
    
    $tracking_data2 = DB::table('tracking_code_form')
                    ->where('page_placement', 'other_form_place')
                    ->where('status', '1')
                    ->get(); 
    
    $head = $second = [];
     
    if(!empty($tracking_data)){
        foreach($tracking_data as $tracking_key => $tracking_val){
            if($tracking_val->placement == 'head'){
                $head[] = $tracking_val->tracking_code;
            }else{
                $head[] = $tracking_val->tracking_code;
            }
        }
    }
    if(!empty($tracking_data2)){
        foreach($tracking_data2 as $tracking_key => $tracking_val){
            if($tracking_val->placement == 'head'){
                $second[] = $tracking_val->tracking_code;
            }else{
                $second[] = $tracking_val->tracking_code;
            }
        }
    }
    
    ?>
    @if(!empty($head) && request()->routeIs('thank-you-lead-form'))
        {!! $head[0] !!}
    @endif
    @if(!empty($second) && request()->routeIs('thank-you'))
        {!! $second[0] !!}
    @endif
</head>
<body>
    @include('frontend.inc.header')
    @yield('content')
    @include('frontend.inc.footer')

    <div id="loading">
        <div class="text-center insideLoader" style="margin: 5%;"><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div>
    </div> 

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.ba-throttle-debounce.min.js') }}" defer></script>
    <script defer src="{{ asset('frontend/js/intelli.min.js') }}" ></script>

    <script defer src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"  ></script>
 
    <script defer src="{{ asset('frontend/js/owl.carousel.min.js') }}"  ></script>
    
    <script defer src="{{ asset('frontend/js/fancybox.js') }}"  ></script>

    <script defer src="{{ asset('frontend/js/custom.js') }}"></script> 
    <!-- 4/2/2022 -->
    <script>
        function myFunction() {
            var element = document.getElementById("homefix_project_area");
            element.classList.add("mystyle");
        }

        function myFunctionOne() {
            var element = document.getElementById("homefix_project_area");
            element.classList.remove("mystyle");
        }
    </script>
  <script> 
    let currentUrl = window.location.href;

    if (currentUrl.includes('%20')) {
        let newUrl = currentUrl.replace(/%20/g, '-');
        window.location.href = newUrl;
    }

$(document).ready(function() { 
    $('#mobile_code').css('padding-left', '86px').attr('placeholder', 'Phone');   

});
 
    $(document).ready(function() {
        
          $(".menu li").find("ul").parent().append("<span></span>");
             $(".menuButton").click(function() {
                 $( ".menuButton" ).toggleClass( "arrow_change" );
                    $(".menuButton + ul").slideToggle();
                  });
            $(".menu ul li span").click(function(){
                if($("span").parent().children("ul").is(":visible")){
                    $(this).parent().siblings().children("ul").slideUp();
                }
                $(this).parent().children("ul").slideToggle();
            });
                
                
            $('.btn-cart').on('click',function() {
                $('.caart_box').toggle(); // Show the cart box on hover
            });
            
            
            // country code dropdown code is here
            setTimeout(function(){
                var iti = $(".mobile_code").intlTelInput({
                	initialCountry: "in",
                	separateDialCode: true, 
                	autoPlaceholder: "off"
                }); 
                
                var selectedFlag = $('.iti__selected-flag');
                selectedFlag.attr({
                    'aria-label': 'Country Code Picker',   
                    'aria-expanded':false,
                    'aria-controls':'countryList',
                    'aria-owns':'countryList',
                    'aria-activedescendant':'',
                    'aria-hidden':false
                });
                
                 
                $(document).on('change', '.mobile_code', function(){
                    var parentContainer = $(this).closest('.form-group');
 
                    var code = parentContainer.find('.iti__selected-dial-code').text(); 
                   mobile =  $(this).val();
                   newVal = code+mobile;
                   console.log(newVal);
                   $('.number_new').val(newVal)
                });
                
                $(document).on('click', '.iti__flag-container', function() { 
                     
                    var selectedFlag = $(this).find('.iti__selected-flag');
                    
                    var code = selectedFlag.find('.iti__selected-dial-code').text(); 
                    
                    $('.country_code').val(code);
                });
                
            }, 3000); 
            // country code dropdown code is here
            
        // Modify the dynamically created navigation buttons
          $('.owl-prev').attr({
            'aria-label': 'Previous slide',
            'role': 'button' 
          });
        
          $('.owl-next').attr({
            'aria-label': 'Next slide',
            'role': 'button' 
          });
 

      });

        $(".myAccount span").click(function() {
             $( ".myAccount span" ).toggleClass( "arrow_change" );
            $(".myAccountDropdown").slideToggle();
        });

      </script>
  <script>
  var btn = $('#button');

  $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
      btn.addClass('show');
    } else {
      btn.removeClass('show');
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });
  </script>


<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"   defer></script>   

<script defer type="text/javascript">
var onloadCallback = function() {
    setTimeout(function(){
        if (document.getElementById('html_element') != null) {
            grecaptcha.render('html_element', {
                'sitekey' : '6LdReU8mAAAAABunZlwMjwKojXzwh-ZbK0bloaR-'
            });
        }
        if (document.getElementById('discreetPuzzle') != null) {
            grecaptcha.render('discreetPuzzle', {
                'sitekey' : '6LdReU8mAAAAABunZlwMjwKojXzwh-ZbK0bloaR-'
            });
        }
        if (document.getElementById('discreetPuzzle1') != null) {
            grecaptcha.render('discreetPuzzle1', {
                'sitekey' : '6LdReU8mAAAAABunZlwMjwKojXzwh-ZbK0bloaR-'
            });
        }
    }, 5000);
};
 
</script>

<script type="text/javascript">
	$(function () {
		$("input[data-bootstrap-switch]").each(function(){
		  $(this).bootstrapSwitch('state', $(this).prop('checked'));
		});
	});
	
	document.addEventListener("DOMContentLoaded", function() {
        var currentUrl = window.location.href;
        var lowercaseUrl = currentUrl.toLowerCase();
        if (currentUrl !== lowercaseUrl) {
            window.location.replace(lowercaseUrl);
        }
    });
	</script> 
    @yield('more-scripts')
    @if(!empty($head) && request()->routeIs('thank-you-lead-form'))
        {!! $head[1] !!}
    @endif
    @if(!empty($second) && request()->routeIs('thank-you'))
        {!! $second[1] !!}
    @endif
    <script>
     $(document).ready(function () {

    function removeErrorOnChange(selector, errorSelector) {
        $(document).on('input change', selector, function () {
            if ($(this).val().trim() !== '') {
                $(errorSelector).text('');
            }
        });
    }

    removeErrorOnChange('.name', '#nameError');
    removeErrorOnChange('.mobile_code', '#phoneError');
    removeErrorOnChange('.serviceName', '#serviceError');


    $(document).on('submit', '.blogForm', function (e) {
        e.preventDefault();

        let isValid = true;
         
        $('.text-danger').text('');

        let name = $('.name').val();
        if (!name || name.trim() === '') {
            $('#nameError').text('Name is required');
            isValid = false;
        }

        let phone = $('.mobile_code').val();
        console.log(phone)
        if (!phone || phone.trim().length != 10) {
            $('#phoneError').text('Enter a valid 10-digit mobile number');
            isValid = false;
        }

        let serviceName = $('.serviceName').val();
        if (!serviceName || serviceName === '') {
            $('#serviceError').text('Service name is required');
            isValid = false;
        }

        if (isValid) {
            this.submit();
        }
    });
});

    </script>
<script>
  document.getElementById("showLoginForm").onclick = function() {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("signupForm").style.display = "none";
  };
  
  document.getElementById("showSignupForm").onclick = function() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("signupForm").style.display = "block";
  };
  
  document.getElementById("switchToSignup").onclick = function() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("signupForm").style.display = "block";
  };

  document.getElementById("switchToLogin").onclick = function() {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("signupForm").style.display = "none";
  };
</script>
    
</body>
</html>
