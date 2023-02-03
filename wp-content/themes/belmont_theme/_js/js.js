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
    $(window)
      .on("load, resize", function mobileViewUpdate() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 992) {
          $(".rt-navigation ul.menu > li.menu-item-has-children > a").each(
            function (index, value) {
              $(value)
                .unbind("click")
                .click(function (e) {
                  e.preventDefault();
                  $(this).next(".sub-menu").slideToggle(500);
                  $(this).parent().toggleClass("open-dropdown");
                });
            }
          );
        }
      })
      .trigger("resize");
  
  // gallery slider
  $('.gallery-slider').slick({
    dots: false,
    arrows: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    padding: 30,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
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

  
});
// Slick Slider 
jQuery('.hero-slider-cl').slick();


