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
});
// Slick Slider 
jQuery('.banner-slider').slick();
