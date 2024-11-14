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
    <link rel="preload" as="image" href="https://bebran.com/public/uploads/1686748384_be-bran-banner1.webp" type="image/webp" />

    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!--<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">-->
    <style>
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
        @media (max-width: 767px) {
            .faqarea .container .row .col-lg-6{
                margin-bottom: 20px !important;
            } 
            .banner_image_new{
                height: 125px !important;
            }
        }
        @media (max-width: 639.98px) {
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
    // Get the current URL
    let currentUrl = window.location.href;
    
    // Check if the URL contains '%20'
    if (currentUrl.includes('%20')) {
        // Replace '%20' with '-'
        let newUrl = currentUrl.replace(/%20/g, '-');
        
        // Redirect to the updated URL
        window.location.href = newUrl;
    }

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
            
            setTimeout(function(){
                var iti = $(".mobile_code").intlTelInput({
                	initialCountry: "in",
                	separateDialCode: true, 
                	autoPlaceholder: "off"
                }); 
                // $(document).on('change', '.mobile_code', function() {
                //     var CNcode = $('.iti__flag-container .iti__selected-flag .iti__selected-dial-code').text();   
                //     $('.slider_from .mobile_code').val(CNcode);
                //     let code = $(this).val();
                //     console.log(code);
                // });
                
                // var code = $('.iti__selected-dial-code').text(); 
                // console.log(code)
                $(document).on('change', '.mobile_code', function(){
                    var parentContainer = $(this).closest('.form-group');
 
                    var code = parentContainer.find('.iti__selected-dial-code').text();
                    console.log(code)
                   mobile =  $(this).val();
                   newVal = code+mobile;
                   console.log(newVal);
                   $('.number_new').val(newVal)
                });
            }, 3000); 
            
            

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

<script type="text/javascript">
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
    }, 5000);
};
</script>

 
 
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
</body>
</html>
