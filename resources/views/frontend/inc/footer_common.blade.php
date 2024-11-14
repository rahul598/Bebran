
<footer class="footer-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 fww">
        <h4>About Us</h4>
        <p>Vulputate consequat varius. Aenean lacus auctor ipsum malesuada rhoncus eget non urna. Suspendisse potenti mauris pretium turpis sit amet nibh
          .fringilla viverra.</p>
        <div class="flogo"><img src="{{ asset('frontend/images/be-bran-footer-logo.webp')}}" alt="be-bran-footer-logo"></div>
      </div>
      <div class="col-lg-3 fww1">
        <h4>contact us</h4>
        <h6><i class="fa fa-map-marker" aria-hidden="true"></i> E-64, Mansarovar Garden, New Delhi - 110015 </h6>
        <h6><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:919205506442">+91-9205506442</a></h6>
        <h6><i class="fa-solid fa-envelope"></i><a href="mailto:info@bebran.com">info@bebran.com</a></h6>
        <h6><i class="fa-brands fa-whatsapp"></i><a href="tel:919205506442">+91-9205506442</a></h6>
        <h6><i class="fa fa-heart" aria-hidden="true"></i>Help </h6>
      </div>
      <div class="col-lg-3 fww2">
        <h4>Our Services</h4>
        <ul>
          <li><a href="#">Phasellus efficitur non mi </a></li>
          <li><a href="#">Nec egestas</a></li>
          <li><a href="#">Egestas augue non elit </a></li>
          <li><a href="#">Eutrum sodales</a></li>
          <li><a href="#">Suspendisse non tellus </a></li>
          <li><a href="#">Auctor tincidunt urna</a></li>
        </ul>
      </div>
      <div class="col-lg-3 fww3">
        <h4>Resources</h4>
        <ul>
          <li><a href="#">Tools </a></li>
          <li><a href="#">Free Books </a></li>
          <li><a href="#">Courses</a></li>
          <li><a href="#">Site Audit</a></li>
          <li><a href="#">Blogs</a></li>
        </ul>
      </div>
      <div class="col-lg-3 fww4">
        <h4>follow us on</h4>
        <ul>
          <li><i class="fa-brands fa-facebook-f"></i><a href="https://www.facebook.com/bebran" target="_blank">Facebook </a></li>
          <li><i class="fa-brands fa-twitter"></i><a href="https://twitter.com/bebran" target="_blank">Twitter </a></li>
          <li><i class="fa-brands fa-linkedin-in"></i><a href=" https://www.linkedin.com/company/bebran" target="_blank">linkdin </a></li>
          <li><i class="fa-brands fa-instagram"></i><a href="https://www.instagram.com/bebran">Instagram </a></li>
          <li><i class="fa fa-users" aria-hidden="true"></i><a href="#" target="_blank">Our Community </a></li>
        </ul>
      </div>
    </div>
    <ol>
      <li><a href="about_us.html">About us</a></li>
      <li><a href="Privacy-Policy.html">Privacy policy</a></li>
      <li><a href="Terms & Condition.html">Terms</a></li>
      <li><a href="Disclaimer.html"> Disclaimer</a></li>
      <li><a href="Refund-Policy.html">Return Policy</a></li>
      <li><a href="contact_us.html">Contact us</a></li>
      <li><a href="#">Sitemap</a></li>
    </ol>
  </div>
</footer>
<div class="payment">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <h5><span>Patment methods:</span> <img src="{{ asset('frontend/images/visa.webp')}}" alt="visa" ></h5>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <h5><span>Buy With Confidence:</span> <img src="{{ asset('frontend/images/ssl.webp')}}" alt="ssl"></h5>
      </div>
    </div>
  </div>
</div>
<div class="copyright">
  <div class="container">
    <h6>Copyright © 2023. <a href="#">BeBran Digital</a>. All Rights Reserved.</h6>
  </div>
</div>
<div class="stykebox">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between">
      <div class="colbox"><a href="tel:919205506442"><span><i class="fa-solid fa-phone"></i></span>Call Us : +91-9205506442</a></div>
      <div class="colbox"><a href="#"><span><i class="fa-brands fa-skype"></i></span>Skype Us : bebrandigital </a></div>
      <div class="colbox"><a href="mailto:info@bebran.com"><span><i class="fa-solid fa-envelope"></i></span>Email Us : info@bebran.com</a></div>
      <div class="colbox"><a href="#"><span><i class="fa-brands fa-whatsapp"></i></span>WhatsApp Us : +91-9205506442</a></div>
    </div>
  </div>
</div>

<a id="button"><span><i class="fa fa-angle-up" aria-hidden="true"></i></span></a> 
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.bundle.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/custom.js"></script> 
<script>
   
  jQuery(document).ready(function() {
        jQuery(".menu li").find("ul").parent().append("<span></span>");
       jQuery(".menuButton").click(function() {
           jQuery( ".menuButton" ).toggleClass( "arrow_change" );
      jQuery(".menuButton + ul").slideToggle(); 
    });
     jQuery(".menu ul li span").click(function(){
           if(jQuery("span").parent().children("ul").is(":visible")){
               jQuery(this).parent().siblings().children("ul").slideUp();
           }
            jQuery(this).parent().children("ul").slideToggle();  
    });
    });
 
 jQuery(".myAccount span").click(function() {
           jQuery( ".myAccount span" ).toggleClass( "arrow_change" );
      jQuery(".myAccountDropdown").slideToggle(); 
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