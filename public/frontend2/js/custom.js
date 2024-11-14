jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > 70) {
    jQuery(".menu-area").addClass("fix");
  } else {
    jQuery(".menu-area").removeClass("fix");
  }
});

jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > 70) {
    jQuery(".moblietop").addClass("fix");
  } else {
    jQuery(".moblietop").removeClass("fix");
  }
});

// banner slider start
jQuery('#banner-slider').owlCarousel({
  loop:true,
  autoplay:true,
  autoplayTimeout: 2000,
  margin:0,
  dots:true,
  nav:false,
   animateOut: 'fadeOut',
  autoplayHoverPause: true,
  responsive:{
    0:{
      items:1
    },
    1199:{
      items:1
    }
  }
});
// banner slider stop


jQuery('.partners-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    margin:25,
    dots:false,
    nav:false,
    navText:[],
    responsive:{
      0:{
        items:2,
        
      },
      480:{
        items:2,
        
      },
      640:{
        items:2,
       
      },
      768:{
        items:3,
         
      },
      992:{
        items:5,
       
      },
      1200:{
        items:5
      }
    }
  });


  jQuery('#related-slider').owlCarousel({
    loop:true,
    autoplay:true,
    margin:10,
    dots:false,
    nav:false,
    navText:[],
    responsive:{
      0:{
        items:2,
        
      },
      480:{
        items:2,
        
      },
      640:{
        items:2,
       
      },
      768:{
        items:3,
         
      },
      992:{
        items:4,
       
      },
      1200:{
        items:4
      }
    }
  });




jQuery('.tool-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    margin:15,
    dots:false,
    nav:false,
    navText:[],
    responsive:{
      0:{
        items:2,
        
      },
      480:{
        items:2,
        
      },
      640:{
        items:2,
       
      },
      768:{
        items:3,
         
      },
      992:{
        items:4,
       
      },
      1200:{
        items:5
      }
    }
  });



jQuery('.digita-carousel').owlCarousel({
    loop:true,
    autoplay:true,
    margin:15,
    dots:false,
    nav:false,
    navText:[],
    responsive:{
      0:{
        items:2,
        
      },
      480:{
        items:2,
        
      },
      640:{
        items:2,
       
      },
      768:{
        items:3,
         
      },
      992:{
        items:4,
       
      },
      1200:{
        items:5
      }
    }
  });




jQuery('.work-carousel').owlCarousel({
    loop:true,
    autoplay:false,
    margin:25,
    dots:false,
    nav:false,
    navText:[],
    responsive:{
      0:{
        items:2,
        
      },
      480:{
        items:2,
        
      },
      640:{
        items:2,
       
      },
      768:{
        items:3,
         
      },
      992:{
        items:4,
       
      },
      1200:{
        items:4
      }
    }
  });
  
  $('.tools-carousel').owlCarousel({
    autoplay:true,
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('.portfolio-img-carousel').owlCarousel({
    autoplay:true,
    loop:true,
    margin:0,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        1000:{
            items:1
        }
    }
});


