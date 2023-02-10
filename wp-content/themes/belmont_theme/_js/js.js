jQuery(document).ready(function($){
    $(".rt-menu-toggle").click(function () {
        $("header.site-header").toggleClass("opened-menu");
        if ($(this).attr("aria-label") === "Open Menu") {
          $(this).attr("aria-label", "Close Menu");
        } else {
          $(this).attr("aria-label", "Open Menu");
        }
    });
    
    // submenu
    $(".bl-navigation ul.menu > li .sub-menu").before(
      "<span class='open-label'></span>"
    );
    $(window).on("resize", function mobileViewUpdate() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 992) {
          $(".bl-navigation ul.menu > li .open-label").click(function(){
            $(this).next(".sub-menu").toggleClass("open-sub-menu");
            $(this).parent().toggleClass("open-dropdown");
          })
            }
        })
      .trigger("resize");
  
  // collapse
  $(".trigger-toggle").click(function () {
    $(".toggle-content").toggleClass("show");
    $(this).toggleClass("only-one");
  });
  $(".option-toggle").click(function () {
    $(".options-content").toggleClass("show-content");
    $(this).toggleClass("opened");
  });
  
  // gallery slider
  $('.gallery-slider').slick({
    dots: false,
    arrows: false,
    infinite: false,
    centerMode: false,
    speed: 300,
    slidesToShow: 4.8,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3.8,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });

   // gallery slider
   $('.hero-slider-bl').slick({
    dots: true,
    arrows: false,
    infinite: true,
     speed: 300,
     fade: true,
     speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      }
    ]
  });

    // testimonial slider
    $('.testimonial-slider').slick({
      dots: false,
      arrows: false,
      infinite: true,
      autoplay: true,
       speed: 400,
      slidesToShow: 1,
      slidesToScroll: 1,
    });
  
  
  // single trailers sldier
  $('.slider-product').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.products-nav'
  });
  $('.products-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider-product',
    arrows: true,
    centerMode: false,
    focusOnSelect: true
  });

});



